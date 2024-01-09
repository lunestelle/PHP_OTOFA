<?php

class Change_motor_automation
{
  use Controller;

  public function index()
  {
    $currentYear = date('Y');
    $requiredChangeMotorYearDifference = 10;

    // Calculate the change motor year
    $changeMotorYear = $currentYear - $requiredChangeMotorYearDifference;

    $tricycleModel = new Tricycle();
    $query = "SELECT tricycles.* 
              FROM tricycles 
              INNER JOIN tricycle_applications 
              ON tricycles.tricycle_application_id = tricycle_applications.tricycle_application_id 
              WHERE tricycles.status = 'Active' 
              AND CAST(tricycle_applications.make_model_year_acquired AS SIGNED) <= {$changeMotorYear}";

    $tricyclesForChangeMotor = $tricycleModel->query($query);

    // Check if there are tricycles for changing motor
    if (!empty($tricyclesForChangeMotor)) {
      foreach ($tricyclesForChangeMotor as $tricycle) {
        $userModel = new User();
        $user = $userModel->first(['user_id' => $tricycle->user_id]);

        // Send SMS and Email notifications for changing motor
        $phoneNumber = $user->phone_number;
        $userName = $user->first_name . ' ' . $user->last_name;
        $email = $user->email;

        $customTextMessage = "Dear {$userName}, Your tricycle is due for a change of motor. Kindly set an appointment through Sakaycle before the deadline to facilitate the process and avoid any inconveniences. To ensure a smooth process, please prepare for the requirements in advance. ";

        $customEmailMessage = "Your tricycle is due for a change of motor. Kindly set an appointment through Sakaycle before the deadline to facilitate the process and avoid any inconveniences. To ensure a smooth process, please prepare for the requirements in advance.";

        $subject = "Tricycle Change Motor Reminder";

        systemNotifications($phoneNumber, $userName, $email, $subject, $customTextMessage, $customEmailMessage);
        $tricycleModel->update(['tricycle_id' => $tricycle->tricycle_id], ['status' => 'Change Motor Required']);
      }

      echo "Tricycle change motor notifications sent successfully.";
    } else {
      echo "No tricycles for changing motor.";
    }
  }
}