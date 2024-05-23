<?php

class Expired_renewal_automation
{
  use Controller;

  public function index()
  {
    $currentDate = date('Y-m-d');
    $deadlineEnd = date('Y') . "-01-20";

    $tricycleStatusesModel = new TricycleStatuses();
    $userModel = new User();
    $tricycleModel = new Tricycle();
    $tricycleApplicationModel = new TricycleApplication();
    $tricycleCinModel = new TricycleCinNumber();

    $toBeExpiredQuery = "SELECT * FROM tricycle_statuses WHERE status = 'Renewal Required' AND '{$currentDate}' > '{$deadlineEnd}'";
    $toBeExpiredRenewal = $tricycleStatusesModel->query($toBeExpiredQuery);

    if (!empty($toBeExpiredRenewal)) {
      foreach ($toBeExpiredRenewal as $tricycle) {
        $user = $userModel->first(['user_id' => $tricycle->user_id]);

        $tricycleData = $tricycleModel->first(['tricycle_id' => $tricycle->tricycle_id]);
        $tricycleApplicationData = $tricycleApplicationModel->first(['tricycle_application_id' => $tricycleData->tricycle_application_id]);

        // Insert Expired Renewal status
        $tricycleStatusesModel->insert([
          'tricycle_id' => $tricycle->tricycle_id,
          'user_id' => $tricycle->user_id,
          'status' => 'Expired Renewal (1st Notice)'
        ]);

        // Delete Renewal Required status
        $tricycleStatusesModel->query("DELETE FROM tricycle_statuses WHERE user_id = '{$tricycle->user_id}' AND tricycle_id = '{$tricycle->tricycle_id}' AND status = 'Renewal Required'");

        $noticeNo = "1st Notice";
        $this->sendNotification($user, $tricycleApplicationData, $noticeNo);
        
        // Update tricycle's expired_notification_sent_at
        $tricycleModel->query("UPDATE tricycles SET expired_notification_sent_at = '{$currentDate}' WHERE tricycle_id = '{$tricycle->tricycle_id}'");
      }
      echo "Renewal Required to Expired Renewal notifications sent successfully.  ";
    } else {
      echo "No Renewal Required notifications sent.  ";
    }

    $expiredQuery = "SELECT * FROM tricycle_statuses WHERE status LIKE 'Expired Renewal%'";
    $tricyclesExpiredRenewal = $tricycleStatusesModel->query($expiredQuery);

    if (!empty($tricyclesExpiredRenewal)) {
      foreach ($tricyclesExpiredRenewal as $expired) {
        $user = $userModel->first(['user_id' => $expired->user_id]);
        $tricycleData = $tricycleModel->first(['tricycle_id' => $expired->tricycle_id]);
        $tricycleApplicationData = $tricycleApplicationModel->first(['tricycle_application_id' => $tricycleData->tricycle_application_id]);

        // Check if 15 days have passed since the last notification
        $lastNotificationDate = $tricycleData->expired_notification_sent_at;
        $notificationInterval = date_diff(date_create($lastNotificationDate), date_create($currentDate))->days;

        if ($notificationInterval >= 15) {
          // Fetch existing notice statuses for the specific tricycle
          $tricycleId = $expired->tricycle_id;
          $userId = $expired->user_id;
          $existingStatusQuery = "SELECT status FROM tricycle_statuses WHERE user_id = '{$userId}' AND tricycle_id = '{$tricycleId}'";
          $existingStatusResult = $tricycleStatusesModel->query($existingStatusQuery);

          // Extract existing statuses into an array
          $existingStatuses = [];
          foreach ($existingStatusResult as $status) {
            $existingStatuses[] = $status->status;
          }

          // Define the sequence of notice statuses
          $sequence = ['Expired Renewal (1st Notice)', 'Expired Renewal (2nd Notice)', 'Expired Renewal (3rd Notice)', 'Dropped'];

          // Determine the current status of the tricycle
          $currentStatusIndex = array_search(end($existingStatuses), $sequence);

          // If the current status is not 'Dropped' and is not the last status in the sequence, update the status
          if ($currentStatusIndex !== false && end($existingStatuses) !== 'Dropped' && $currentStatusIndex < count($sequence) - 1) {
            // Find the next status in the sequence
            $nextStatus = $sequence[$currentStatusIndex + 1];

            // Update the status to the next one in the sequence
            $tricycleStatusesModel->query("UPDATE tricycle_statuses SET status = '{$nextStatus}' WHERE user_id = '{$userId}' AND tricycle_id = '{$tricycleId}' AND status = '{$existingStatuses[count($existingStatuses) - 1]}'");

            // If the next status is 'Dropped', delete other statuses for this tricycle
            if ($nextStatus === 'Dropped') {
              $tricycleStatusesModel->query("DELETE FROM tricycle_statuses WHERE user_id = '{$userId}' AND tricycle_id = '{$tricycleId}' AND status != 'Dropped'");

              // Update tricycle CIN status
              $tricycleCinData = $tricycleCinModel->first(['tricycle_cin_number_id' => $tricycleData->cin_id]);
              if (!empty($tricycleCinData)) {
                $tricycleCinModel->update(['cin_number' => $tricycleCinData->cin_number], ['is_used' => 0, 'user_id' => null]);
              }

              $this->sendDroppedNotification($user, $tricycleApplicationData);
            } else {
              if ($nextStatus === "Expired Renewal (2nd Notice)") {
                $noticeNo = "2nd Notice";
                $this->sendNotification($user, $tricycleApplicationData, $noticeNo);
              } elseif ($nextStatus === "Expired Renewal (3rd Notice)") {
                $noticeNo = "3rd Notice";
                $this->sendNotification($user, $tricycleApplicationData, $noticeNo);
              }
              // Update tricycle's expired_notification_sent_at
              $tricycleModel->query("UPDATE tricycles SET expired_notification_sent_at = '{$currentDate}' WHERE tricycle_id = '{$tricycleId}'");
            }                
          }
        }
      }
      echo "Expired Renewal notifications sent successfully.  ";
    } else {
      echo "No expired renewal notifications sent.  ";
    }
  }

  private function sendNotification($user, $tricycleApplicationData, $noticeNo)
  {
    $phoneNumber = $user->phone_number;
    $userName = $user->first_name . ' ' . $user->last_name;
    $email = $user->email;

    $routeArea = $tricycleApplicationData->route_area;

    $tricycleCinModel = new TricycleCinNumber();
    $cinData = $tricycleCinModel->first(['tricycle_cin_number_id' => $tricycleApplicationData->tricycle_cin_number_id]);

    $cinNumber = $cinData->cin_number;
    $rootPath = ROOT;
    $penaltyFee = ($routeArea === 'Free Zone / Zone 1') ? '122.50' : '272.50';

    $customTextMessage = "Hello {$userName},\n\nWe're giving you a {$noticeNo} that the tricycle franchise renewal period, from December 20th to January 20th, has ended. Unfortunately, your CIN #{$cinNumber} in {$routeArea} has expired, requiring immediate renewal. \n\nTo renew, kindly schedule an appointment through OTOFA. Once approved, submit necessary requirements to the Transportation Development Franchising and Regulatory Office (TDFRO) on the specified date. Please note, a ₱{$penaltyFee} late renewal charge applies, and failure to renew may lead to an embargo of your ownership rights to the CIN by TDFRO personnel.\n\nYour prompt attention is appreciated. Thank you for your cooperation. For more details, please check our website by clicking the link: {$rootPath}.\n";

    $customEmailMessage = "<div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>We're giving you a {$noticeNo} that the tricycle franchise renewal period, from December 20th to January 20th, has ended. Unfortunately, your CIN #{$cinNumber} in {$routeArea} has expired, requiring immediate renewal.</div><div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>To renew, kindly schedule an appointment through OTOFA. Once approved, submit necessary requirements to the Transportation Development Franchising and Regulatory Office (TDFRO) on the specified date. Please note, a ₱{$penaltyFee} late renewal charge applies, and failure to renew may lead to an embargo of your ownership rights to the CIN by TDFRO personnel.</div><div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>Your prompt attention is appreciated. Thank you for your cooperation.</div>";

    $subject = "Expired Renewal Reminder - {$noticeNo}";

    systemNotifications($phoneNumber, $userName, $email, $subject, $customTextMessage, $customEmailMessage);
  }

  private function sendDroppedNotification($user, $tricycleApplicationData)
  {
    $phoneNumber = $user->phone_number;
    $userName = $user->first_name . ' ' . $user->last_name;
    $email = $user->email;

    $tricycleCinModel = new TricycleCinNumber();
    $cinData = $tricycleCinModel->first(['tricycle_cin_number_id' => $tricycleApplicationData->tricycle_cin_number_id]);

    $cinNumber = $cinData->cin_number;

    $customTextMessage = "Hello {$userName},\n\nWe hope this message finds you well. It is with regret that we inform you that your tricycle franchise for CIN #{$cinNumber} has been dropped due to non-renewal. We encourage you to reach out to us if you have any questions or concerns regarding the non-renewal of your franchise.\n\nThank you for your understanding and cooperation.";

    $customEmailMessage = "<div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>We hope this message finds you well. It is with regret that we inform you that your tricycle franchise for CIN #{$cinNumber} has been dropped due to non-renewal. We encourage you to reach out to us if you have any questions or concerns regarding the non-renewal of your franchise.</div>";

    $subject = "Tricycle Franchise Dropped Notification";

    systemNotifications($phoneNumber, $userName, $email, $subject, $customTextMessage, $customEmailMessage);
  }

  private function getOrdinalSuffix($number) {
    if ($number % 100 >= 11 && $number % 100 <= 13) {
      return 'th';
    }

    switch ($number % 10) {
      case 1: return 'st';
      case 2: return 'nd';
      case 3: return 'rd';
      default: return 'th';
    }
  }
}