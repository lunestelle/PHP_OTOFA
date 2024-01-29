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
          'status' => 'Expired Renewal'
        ]);

        // Delete Renewal Required status
        $tricycleStatusesModel->query("DELETE FROM tricycle_statuses WHERE user_id = '{$tricycle->user_id}' AND tricycle_id = '{$tricycle->tricycle_id}' AND status = 'Renewal Required'");

        // Insert initial Sent Notice status
        $tricycleStatusesModel->insert([
          'tricycle_id' => $tricycle->tricycle_id,
          'user_id' => $tricycle->user_id,
          'status' => '1st Notice'
        ]);

        $this->sendNotification($user, $tricycleApplicationData);
        
        // Update tricycle's expired_notification_sent_at
        $tricycleModel->query("UPDATE tricycles SET expired_notification_sent_at = '{$currentDate}' WHERE tricycle_id = '{$tricycle->tricycle_id}'");
      }
      echo "Renewal Required to Expired Renewal notifications sent successfully.  ";
    } else {
      echo "Renewal Required to Expired Renewal notifications sent.  ";
    }

    $expiredQuery = "SELECT * FROM tricycle_statuses WHERE status = 'Expired Renewal'";
    $tricyclesExpiredRenewal = $tricycleStatusesModel->query($expiredQuery);

    if (!empty($tricyclesExpiredRenewal)) {
      foreach ($tricyclesExpiredRenewal as $expired) {
        $user = $userModel->first(['user_id' => $expired->user_id]);
        $tricycleData = $tricycleModel->first(['tricycle_id' => $expired->tricycle_id]);

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
          $sequence = ['1st Notice', '2nd Notice', '3rd Notice', 'Dropped'];

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
              if ($tricycleCinData) {
                $tricycleCinModel->update(['cin_number' => $tricycleCinData->cin_number], ['is_used' => 0, 'user_id' => null]);
              }

              $this->sendDroppedNotification($user);
            } else {
              // Send notification for the updated status
              $tricycleApplicationData = $tricycleApplicationModel->first(['tricycle_application_id' => $tricycleData->tricycle_application_id]);
              $this->sendNotification($user, $tricycleApplicationData);
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

  private function sendNotification($user, $tricycleApplicationData)
  {
    $phoneNumber = $user->phone_number;
    $userName = $user->first_name . ' ' . $user->last_name;
    $email = $user->email;

    $routeArea = $tricycleApplicationData->route_area;

    $tricycleCinModel = new TricycleCinNumber();
    $cinData = $tricycleCinModel->first(['tricycle_cin_number_id' => $tricycleApplicationData->tricycle_cin_number_id]);

    $cinNumber = $cinData->cin_number;

    $penaltyFee = ($routeArea === 'Free Zone / Zone 1') ? '122.50' : '272.50';

    $customTextMessage = "Hello {$userName},\n\nWe would like to inform you that the renewal period for tricycle franchises, which occurred from December 20 to January 20, has concluded. Unfortunately, your tricycle franchise in {$routeArea} for CIN #{$cinNumber} has expired, and renewal is required. \n\n To facilitate the renewal process, we kindly request you to set an appointment through OTOFA. Once your appointment is approved, you may proceed to submit the necessary requirements to the Transportation Development Franchising and Regulatory Office (TDFRO) on the specified date. \n\n Please be aware that a penalty of ₱{$penaltyFee} is applicable due to late renewal.\n\nYour prompt attention to this matter is greatly appreciated. Thank you for your cooperation.\n";

    $customEmailMessage = "<div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>We would like to inform you that the renewal period for tricycle franchises, which occurred from December 20 to January 20, has concluded. Unfortunately, your tricycle franchise in {$routeArea} for CIN #{$cinNumber} has expired, and renewal is required.</div><div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>To facilitate the renewal process, we kindly request you to set an appointment through OTOFA. Once your appointment is approved, you may proceed to submit the necessary requirements to the Transportation Development Franchising and Regulatory Office (TDFRO) on the specified date. Please be aware that a penalty of ₱{$penaltyFee} is applicable due to late renewal. Your prompt attention to this matter is greatly appreciated. Thank you for your cooperation.</div>";

    $subject = "Tricycle Franchise Expired Renewal Reminder";

    systemNotifications($phoneNumber, $userName, $email, $subject, $customTextMessage, $customEmailMessage);
  }

  private function sendDroppedNotification($user)
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