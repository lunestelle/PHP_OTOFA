<?php

class Expired_renewal_automation
{
  use Controller;

  public function index()
  {
    $currentDate = date('Y-m-d');
    $deadlineEnd = date('Y') . "-01-20";

    $tricyclesModel = new Tricycle();
    $userModel = new User();

    $query = "SELECT * FROM tricycles WHERE status = 'Renewal Required' AND '{$currentDate}' > '{$deadlineEnd}'";
    $tricyclesExpiredRenewal = $tricyclesModel->query($query);

    if (!empty($tricyclesExpiredRenewal)) {
      foreach ($tricyclesExpiredRenewal as $tricycle) {
        $user = $userModel->first(['user_id' => $tricycle->user_id]);

        $phoneNumber = $user->phone_number;
        $userName = $user->first_name . ' ' . $user->last_name;
        $email = $user->email;

        $customTextMessage = "Hello {$userName},\n\nWe would like to inform you that the renewal period for tricycle franchises, which occurred from December 20 to January 20, has concluded. Unfortunately, your tricycle franchise has expired, and renewal is required. \n\n To facilitate the renewal process, we kindly request you to set an appointment through Sakaycle. Once your appointment is approved, you may proceed to submit the necessary requirements to the Transportation Development Franchising and Regulatory Office (TDFRO) on the specified date. \n\n Please be aware that a penalty of ₱150.00 is applicable due to late renewal.\n\nYour prompt attention to this matter is greatly appreciated. Thank you for your cooperation.";

        $customEmailMessage = "<div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>We would like to inform you that the renewal period for tricycle franchises, which occurred from December 20 to January 20, has concluded. Unfortunately, your tricycle franchise has expired, and renewal is required.</div>\n <div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>To facilitate the renewal process, we kindly request you to set an appointment through Sakaycle. Once your appointment is approved, you may proceed to submit the necessary requirements to the Transportation Development Franchising and Regulatory Office (TDFRO) on the specified date. Please be aware that a penalty of ₱150.00 is applicable due to late renewal. Your prompt attention to this matter is greatly appreciated. Thank you for your cooperation.</div>";

        $subject = "Tricycle Franchise Expired Renewal Reminder";

        systemNotifications($phoneNumber, $userName, $email, $subject, $customTextMessage, $customEmailMessage);
      }
      echo "Renewal expired notifications sent successfully."; 
    } else {
      echo "No expired renewal notifications sent.";
      return;
    }
  }
}
