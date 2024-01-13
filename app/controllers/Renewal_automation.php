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

      if (!empty($tricyclesForRenewal)) {
        foreach ($tricyclesForRenewal as $tricycle) {
          $userModel = new User();
          $user = $userModel->first(['user_id' => $tricycle->user_id]);
    
          $phoneNumber = $user->phone_number;
          $userName = $user->first_name . ' ' . $user->last_name;
          $email = $user->email;
    
          $customTextMessage = "Hello {$userName},\n\nYour tricycle is due for renewal. Please be advised of the upcoming deadline for renewal, from December 20 to January 20. A penalty will be applied for renewals beyond this period.\n\nTo ensure a systematic process, we kindly request you to set an appointment through Sakaycle before the renewal deadline. Once your appointment is approved, you are then required to visit our office on the scheduled date. During this visit, kindly submit the necessary documents to complete the tricycle renewal process.\n\nThank you for your prompt attention to this matter.\n";
    
          $customEmailMessage = "<div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>Your tricycle is due for renewal. Please be advised of the upcoming deadline for renewal, from December 20 to January 20. A penalty will be applied for renewals beyond this period.</div><div style='text-align: justify; margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>To ensure a systematic process, we kindly request you to set an appointment through Sakaycle before the renewal deadline. Once your appointment is approved, you are then required to visit our office on the scheduled date. During this visit, kindly submit the necessary documents to complete the tricycle renewal process. Thank you for your prompt attention to this matter.</div>";
    
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