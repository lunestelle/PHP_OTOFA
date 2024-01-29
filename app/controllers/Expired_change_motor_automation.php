<?php

class Expired_change_motor_automation
{
  use Controller;

  public function index()
  {
    $currentDate = date('Y-m-d');

    $tricycleStatusesModel = new TricycleStatuses();
    $userModel = new User();
    $tricycleModel = new Tricycle();
    $tricycleApplicationModel = new TricycleApplication();
    $tricycleCinModel = new TricycleCinNumber();

    $toBeExpiredQuery = "SELECT ta.*, ts.*, t.cin_id AS cin_id FROM tricycles AS t JOIN tricycle_applications AS ta ON t.tricycle_application_id = ta.tricycle_application_id JOIN tricycle_statuses AS ts ON t.tricycle_id = ts.tricycle_id WHERE ts.status = 'Change Motor Required' AND ta.make_model_expiry_date = '{$currentDate}'";

    $toBeExpiredChangeMotor = $tricycleModel->query($toBeExpiredQuery);

    if (!empty($toBeExpiredChangeMotor)) {
      foreach ($toBeExpiredChangeMotor as $tricycle) {
        $user = $userModel->first(['user_id' => $tricycle->user_id]);

        $tricycleData = $tricycleModel->first(['tricycle_id' => $tricycle->tricycle_id]);
        $tricycleApplicationData = $tricycleApplicationModel->first(['tricycle_application_id' => $tricycleData->tricycle_application_id]);

        // Insert Expired Motor status
        $tricycleStatusesModel->insert([
          'tricycle_id' => $tricycle->tricycle_id,
          'user_id' => $tricycle->user_id,
          'status' => 'Expired Motor (1st Notice)'
        ]);

        // Delete Change Motor Required status
        $tricycleStatusesModel->query("DELETE FROM tricycle_statuses WHERE user_id = '{$tricycle->user_id}' AND tricycle_id = '{$tricycle->tricycle_id}' AND status = 'Change Motor Required'");

        $this->sendNotification($user, $tricycleApplicationData);
        
        // Update tricycle's expired_change_motor_notification_sent_at
        $tricycleModel->query("UPDATE tricycles SET expired_change_motor_notification_sent_at = '{$currentDate}' WHERE tricycle_id = '{$tricycle->tricycle_id}'");
      }
      echo "Change Motor Required to Expired Motor notifications sent successfully.  ";
    } else {
      echo "No Change Motor Required notifications sent.  ";
    }

    $expiredQuery = "SELECT * FROM tricycle_statuses WHERE status LIKE 'Expired Motor%'";
    $tricyclesExpiredChangeMotor = $tricycleStatusesModel->query($expiredQuery);

    if (!empty($tricyclesExpiredChangeMotor)) {
      foreach ($tricyclesExpiredChangeMotor as $expired) {
        $user = $userModel->first(['user_id' => $expired->user_id]);
        $tricycleData = $tricycleModel->first(['tricycle_id' => $expired->tricycle_id]);
        $tricycleApplicationData = $tricycleApplicationModel->first(['tricycle_application_id' => $tricycleData->tricycle_application_id]);

        // Check if 15 days have passed since the last notification
        $lastNotificationDate = $tricycleData->expired_change_motor_notification_sent_at;
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
          $sequence = ['Expired Motor (1st Notice)', 'Expired Motor (2nd Notice)', 'Expired Motor (3rd Notice)', 'Dropped'];

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
              $this->sendNotification($user, $tricycleApplicationData);
              // Update tricycle's expired_change_motor_notification_sent_at
              $tricycleModel->query("UPDATE tricycles SET expired_change_motor_notification_sent_at = '{$currentDate}' WHERE tricycle_id = '{$tricycleId}'");
            }                
          }
        }
      }
      echo "Expired Motor notifications sent successfully.  ";
    } else {
      echo "No expired Motor notifications sent.  ";
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

    $customTextMessage = "Hello {$userName},\n\nWe would like to inform you that the motor of your tricycle with CIN #{$cinNumber} has expired and requires immediate replacement.\n\nTo facilitate the motor replacement process, please schedule an appointment through OTOFA. Upon approval, kindly submit the necessary requirements to the Transportation Development Franchising and Regulatory Office (TDFRO) on the assigned date.\n\nFailure to replace the motor may result in the embargo of your ownership rights to the CIN by TDFRO personnel.\n\nA penalty of ₱{$penaltyFee} applies for late motor replacement.\n\nWe appreciate your prompt attention to this matter. Thank you for your cooperation.\n";

    $customEmailMessage = "<div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>We would like to inform you that the motor of your tricycle with CIN #{$cinNumber} has expired and requires immediate replacement.</div><div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>To facilitate the motor replacement process, please schedule an appointment through OTOFA. Upon approval, kindly submit the necessary requirements to the Transportation Development Franchising and Regulatory Office (TDFRO) on the assigned date.</div><div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>Failure to replace the motor may result in the embargo of your ownership rights to the CIN by TDFRO personnel.</div><div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>A penalty of ₱{$penaltyFee} applies for late motor replacement.We appreciate your prompt attention to this matter. Thank you for your cooperation.</div>";

    $subject = "Expired Motor Reminder";

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

    $customTextMessage = "Hello {$userName},\n\nWe hope this message finds you well. Unfortunately, we must inform you that your tricycle franchise for CIN #{$cinNumber} has been dropped due to non-compliance with the required Change Motor procedure. As part of our commitment to safety and regulatory compliance, it's crucial to ensure timely maintenance and adherence to our operational standards.\n\nWe understand that unforeseen circumstances may arise, and we encourage you to reach out to us if you require assistance or clarification regarding the Change Motor process.\n\nThank you for your understanding and cooperation.";

    $customEmailMessage = "<div style='text-align: justify; margin-top: 10px; color: #455056; font-size: 15px; line-height: 24px;'>We hope this message finds you well. Unfortunately, we must inform you that your tricycle franchise for CIN #{$cinNumber} has been dropped due to non-compliance with the required Change Motor procedure. As part of our commitment to safety and regulatory compliance, it's crucial to ensure timely maintenance and adherence to our operational standards.<br><br>We understand that unforeseen circumstances may arise, and we encourage you to reach out to us if you require assistance or clarification regarding the Change Motor process.<br><br>Thank you for your understanding and cooperation.</div>";

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