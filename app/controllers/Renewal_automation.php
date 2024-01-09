<?php

class Renewal_automation
{
  use Controller;

  public function index()
  {
    $renewalDate = date('Y-12-20'); // December 20 of the current year
    $currentDate = date('Y-m-d');

    if ($currentDate === $renewalDate) {
      $tricycleModel = new Tricycle();
      $tricyclesForRenewal = $tricycleModel->where(['status' => 'Active']);

      // Check if there are tricycles for renewal
      if (!empty($tricyclesForRenewal)) {
        // Process tricycles for renewal
        foreach ($tricyclesForRenewal as $tricycle) {
          $userModel = new User();
          $user = $userModel->first(['user_id' => $tricycle->user_id]);
    
          // Send SMS and Email notifications for tricycle renewal
          $phoneNumber = $user->phone_number;
          $userName = $user->first_name . ' ' . $user->last_name;
          $email = $user->email;
    
          $customTextMessage = "Dear {$userName}, Your tricycle is due for renewal. Please proceed to our office for the renewal process.To ensure a smooth process, please prepare for the requirements in advance. The deadline for renewal is on January 20. <br> To facilitate your renewal, kindly set an appointment through Sakaycle before the deadline to secure your renewal slot and avoid any inconveniences.";
    
          $customEmailMessage = "Your tricycle is due for renewal. Please proceed to our office for the renewal process. To ensure a smooth process, please prepare for the requirements in advance. The deadline for renewal is on January 20. To facilitate your renewal, kindly set an appointment through Sakaycle before the deadline to secure your renewal slot and avoid any inconveniences.";
    
          $subject = "Tricycle Renewal Reminder";
    
          systemNotifications($phoneNumber, $userName, $email, $subject, $customTextMessage, $customEmailMessage);
    
          // Update tricycle status to "Renewal Required"
          $tricycleModel->update(['tricycle_id' => $tricycle->tricycle_id], ['status' => 'Renewal Required']);
        }

        echo "Tricycle renewal notifications sent successfully."; 
      }
    } else {
      echo "Not the renewal date. No notifications sent.";
      return;
    }
  }
}