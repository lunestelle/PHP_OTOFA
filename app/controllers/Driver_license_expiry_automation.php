<?php

class Driver_license_expiry_automation
{
  use Controller;

  public function index()
  {
    $currentDate = date('Y-m-d');

    // Retrieve active drivers whose driver license expiry date is today or a past date
    $driverModel = new Driver();
    $query = "SELECT * FROM drivers WHERE license_expiry_date <= '$currentDate' AND driver_id IN (SELECT driver_id FROM driver_statuses WHERE status = 'Active')";
    $activeDrivers = $driverModel->query($query);

    if (!empty($activeDrivers)) {
      foreach ($activeDrivers as $driver) {
        // Check if the driver already has the "Driver License Expired" status
        $driverStatusModel = new DriverStatuses();
        $existingStatus = $driverStatusModel->where(['driver_id' => $driver->driver_id, 'status' => 'Driver License Expired']);

        if (empty($existingStatus)) {
          // If the status does not exist, send notifications and update status
          $userModel = new User();
          $user = $userModel->first(['user_id' => $driver->user_id]);

          $phoneNumber = $user->phone_number;
          $email = $user->email;
          $userName = $user->first_name . ' ' . $user->last_name;

          // Retrieve tricycle CIN number associated with the driver
          $tricycleCINModel = new TricycleCinNumber();
          $tricycleCIN = $tricycleCINModel->first(['tricycle_cin_number_id' => $driver->tricycle_cin_number_id]);
          $tricycleCINNumber = $tricycleCIN->cin_number;
          $driverName = $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name;

          $subject = "Driver License Expiry Reminder";

          $customTextMessage = "Hello {$userName},\n\nWe wanted to bring to your attention that the driver's license of $driverName, who drives the tricycle with CIN # $tricycleCINNumber, has expired.\n\nWe highly advise reaching out to the driver to ensure the timely renewal of their license. Doing so will help prevent any potential issues with the LTO and avoid unnecessary fines.\n\nOnce the driver has renewed their license, please ensure that the driver's information is updated in the system.\n\nThank you for your prompt attention to this matter.\n";

          $customEmailMessage = "<div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>We wanted to bring to your attention that the driver's license of $driverName, who drives the tricycle with CIN # $tricycleCINNumber, has expired.</div><div style='text-align: justify; margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>We highly advise reaching out to the driver to ensure the timely renewal of their license. Doing so will help prevent any potential issues with the LTO and avoid unnecessary fines.</div><div style='text-align: justify; margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>Once the driver has renewed their license, please ensure that the driver's information is updated in the system. Thank you for your prompt attention to this matter.</div>";

          systemNotifications($phoneNumber, $userName, $email, $subject, $customTextMessage, $customEmailMessage);

          // Update driver status to "Driver License Expired"
          $driverStatusModel->insert(['driver_id' => $driver->driver_id, 'status' => 'Driver License Expired']);

          // Update the last notification date
          $driverModel->update(['driver_id' => $driver->driver_id], ['last_notification_date' => $currentDate]);
        } else {
          // If the status exists, check if it's been more than 15 days since the last notification
          $lastNotificationDate = $driver->last_notification_date;

          if ($lastNotificationDate === null || (strtotime($currentDate) - strtotime($lastNotificationDate)) >= 15 * 24 * 60 * 60) {
            // If it's the first notification or if it's been more than 15 days, send notifications again
            $userModel = new User();
            $user = $userModel->first(['user_id' => $driver->user_id]);

            $phoneNumber = $user->phone_number;
            $email = $user->email;
            $userName = $user->first_name . ' ' . $user->last_name;

            // Retrieve tricycle CIN number associated with the driver
            $tricycleCINModel = new TricycleCinNumber();
            $tricycleCIN = $tricycleCINModel->first(['tricycle_cin_number_id' => $driver->tricycle_cin_number_id]);
            $tricycleCINNumber = $tricycleCIN->cin_number;
            $driverName = $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name;

            $subject = "Driver License Expiry Reminder";
            
            $customTextMessage = "Hello {$userName},\n\nWe wanted to bring to your attention that the driver's license of $driverName, who drives the tricycle with CIN # $tricycleCINNumber, has expired.\n\nWe highly advise reaching out to the driver to ensure the timely renewal of their license. Doing so will help prevent any potential issues with the LTO and avoid unnecessary fines.\n\nOnce the driver has renewed their license, please ensure that the driver's information is updated in the system.\n\nThank you for your prompt attention to this matter.\n";

            $customEmailMessage = "<div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>We wanted to bring to your attention that the driver's license of $driverName, who drives the tricycle with CIN # $tricycleCINNumber, has expired.</div><div style='text-align: justify; margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>We highly advise reaching out to the driver to ensure the timely renewal of their license. Doing so will help prevent any potential issues with the LTO and avoid unnecessary fines.</div><div style='text-align: justify; margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>Once the driver has renewed their license, please ensure that the driver's information is updated in the system. Thank you for your prompt attention to this matter.</div>";

            systemNotifications($phoneNumber, $userName, $email, $subject, $customTextMessage, $customEmailMessage);

            // Update the last notification date
            $driverModel->update(['driver_id' => $driver->driver_id], ['last_notification_date' => $currentDate]);
          }
        }
      }

      echo "Notifications sent successfully.";
    } else {
      echo "No active drivers with license expiry today.";
    }
  }
}