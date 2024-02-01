<?php

class Renewal_automation
{
  use Controller;

  public function index()
  {
    $renewalDate = date('Y-12-20'); // December 20 of the current year
    $currentDate = date('Y-m-d');

    if ($currentDate === $renewalDate) {
      $tricycleStatusesModel = new TricycleStatuses();
      $tricyclesForRenewal = $tricycleStatusesModel->where(['status' => 'Active']);

      if (!empty($tricyclesForRenewal)) {
        foreach ($tricyclesForRenewal as $tricycle) {
          // Check if "Renewal Required" status already exists for this tricycle
          $existingRenewalStatus = $tricycleStatusesModel->where(['tricycle_id' => $tricycle->tricycle_id, 'status' => 'Renewal Required']);

          if (empty($existingRenewalStatus)) {
            $userModel = new User();
            $user = $userModel->first(['user_id' => $tricycle->user_id]);
    
            $phoneNumber = $user->phone_number;
            $userName = $user->first_name . ' ' . $user->last_name;
            $email = $user->email;

            $tricycleModel = new Tricycle();
            $tricycleData = $tricycleModel->first(['tricycle_id' => $tricycle->tricycle_id]);

            $tricycleCinModel = new TricycleCinNumber();
            $cinData = $tricycleCinModel->first(['tricycle_cin_number_id' => $tricycleData->cin_id]);
            $cinNumber = $cinData->cin_number;

            $tricycleApplicationModel = new TricycleApplication();
            $tricycleApplicationData = $tricycleApplicationModel->first(['tricycle_application_id' => $tricycleData->tricycle_application_id]);

            $routeArea = $tricycleApplicationData->route_area;
            $rootPath = ROOT;

            $penaltyFee = ($routeArea === 'Free Zone / Zone 1') ? '122.50' : '272.50';

            $customTextMessage = "Hello {$userName},\n\nYour tricycle CIN #{$cinNumber} is due for renewal. Please be advised of the upcoming deadline for renewal, from December 20th to January 20th. A penalty of ₱{$penaltyFee} will be applied for renewals beyond this period.\n\nTo ensure a systematic process, we kindly request you to set an appointment through OTOFA before the renewal deadline. Once your appointment is approved, you are then required to visit our office on the scheduled date. During this visit, kindly submit the necessary documents to complete the tricycle renewal process.\n\nYour prompt attention to this matter is greatly appreciated. Thank you for your cooperation.\nFor more details, please check our website by clicking the link: {$rootPath}.\n";

            $customEmailMessage = "<div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>Your tricycle CIN #{$cinNumber} is due for renewal. Please be advised of the upcoming deadline for renewal, from December 20th to January 20th. A penalty of &#8369;{$penaltyFee} will be applied for renewals beyond this period.</div><div style='text-align: justify; margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>To ensure a systematic process, we kindly request you to set an appointment through OTOFA before the renewal deadline. Once your appointment is approved, you are then required to visit our office on the scheduled date. During this visit, kindly submit the necessary documents to complete the tricycle renewal process. Thank you for your prompt attention to this matter.</div>";
    
            $subject = "Tricycle Renewal Reminder";
      
            systemNotifications($phoneNumber, $userName, $email, $subject, $customTextMessage, $customEmailMessage);
            $tricycleStatusesModel->insert(['tricycle_id' => $tricycle->tricycle_id, 'user_id' => $tricycle->user_id, 'status' => 'Renewal Required']);
          }
        }

        if ($existingRenewalStatus) {
          echo "Renewal Required Status already exists. ";
        } else {
          echo "Tricycle renewal notifications sent successfully.  ";
        }
      }
    } else {
      echo "Not the renewal date. No notifications sent.";
      return;
    }
  }
}