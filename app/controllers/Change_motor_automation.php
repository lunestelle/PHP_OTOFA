<?php

class Change_motor_automation
{
  use Controller;

  public function index()
  {
    $currentDate = date('Y-m-d');

    // Calculate the date one week before
    $oneWeekBefore = date('Y-m-d', strtotime('+1 week'));

    $tricycleModel = new Tricycle();
    $tricycleStatusesModel = new TricycleStatuses();

    $query = "SELECT ta.*, ts.*, t.cin_id AS cin_id FROM tricycles AS t JOIN tricycle_applications AS ta ON t.tricycle_application_id = ta.tricycle_application_id JOIN tricycle_statuses AS ts ON t.tricycle_id = ts.tricycle_id WHERE ts.status = 'Active' AND ta.make_model_expiry_date = DATE_ADD(CURDATE(), INTERVAL 1 WEEK)";
    
    $applicationsToNotify = $tricycleModel->query($query);

    if (!empty($applicationsToNotify)) {
      foreach ($applicationsToNotify as $application) {
        // Check if the status already exists for the tricycle
        $existingStatus = $tricycleStatusesModel->first([
          'tricycle_id' => $application->tricycle_id,
          'status' => 'Change Motor Required'
        ]);

        // If the status doesn't exist, insert it and send notification
        if (!$existingStatus) {
          $userModel = new User();
          $user = $userModel->first(['user_id' => $application->user_id]);

          $tricycleStatusesModel->insert([
            'tricycle_id' => $application->tricycle_id,
            'user_id' => $application->user_id,
            'status' => 'Change Motor Required'
          ]);

          $this->sendNotification($user, $application);

          $tricycleModel->query("UPDATE tricycles SET change_motor_notification_sent_at = '{$currentDate}' WHERE tricycle_id = '{$application->tricycle_id}'");
        }
      }

      if ($existingStatus) {
        echo "Change Motor Required Status already exists. ";
      } else {
        echo "Change Motor Required notifications sent successfully.  ";
      }
    } else {
      echo "No Change Motor Required Tricycles.  ";
    }
  }

  private function sendNotification($user, $application)
  {
    $userName = $user->first_name . ' ' . $user->last_name;
    $phoneNumber = $user->phone_number;
    $email = $user->email;
    $expiryDate = date('F j, Y', strtotime($application->make_model_expiry_date));

    $tricycleCinModel = new TricycleCinNumber();
    $cinData = $tricycleCinModel->first(['tricycle_cin_number_id' => $application->cin_id]);

    $cinNumber = $cinData->cin_number;

    $subject = "Change Motor Reminder";

    $customTextMessage = "Hello {$userName},\n\nYour tricycle CIN #$cinNumber is due for a change of motor which is expiring on $expiryDate. Kindly set an appointment through Sakaycle before the deadline to facilitate the process and avoid any inconveniences. \n\nTo ensure a smooth process, please prepare for the requirements in advance.\n\nYour prompt attention to this matter is greatly appreciated. Thank you for your cooperation.\n";

    $customEmailMessage = "<div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>Your tricycle CIN #$cinNumber is due for a change of motor which is expiring on $expiryDate. Kindly set an appointment through Sakaycle before the deadline to facilitate the process and avoid any inconveniences. To ensure a smooth process, please prepare for the requirements in advance. Your prompt attention to this matter is greatly appreciated. Thank you for your cooperation.</div>";

    systemNotifications($phoneNumber, $userName, $email, $subject, $customTextMessage, $customEmailMessage);
  }
}