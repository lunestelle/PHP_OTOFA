<?php

class Appointment_process_automation
{
  use Controller;

  public function index()
  {
    // Update appointments with status 'Approved' and appointment date 1 week past
    $this->expiredApprovedAppointment();

    // Update appointments with status 'Pending' and appointment date 1 month past
    $this->pendingToDeclinedAppointment();

    // Send notifications for appointments a day before and on the day of the appointment
    $this->approvedAppointmentReminder();

    echo "Appointment status automation completed. <br>  ";
  }

  protected function expiredApprovedAppointment()
  {
    $oneWeekAgo = date('Y-m-d', strtotime('-1 week'));
    $appointments = new Appointment();
    $query = "SELECT * FROM appointments
              WHERE status = 'Approved' AND appointment_date <= '{$oneWeekAgo}'";
    $appointmentsToUpdate = $appointments->query($query);

    if (!empty($appointmentsToUpdate)) {
      foreach ($appointmentsToUpdate as $appointment) {
        $query = "UPDATE appointments
                  SET status = 'Declined', comments = 'User Failed to show on the set approved appointment.'
                  WHERE appointment_id = {$appointment->appointment_id}";
        $appointments->query($query);

        $userModel = new User();
        $user = $userModel->first(['user_id' => $appointment->user_id]);
        $phoneNumber = $user->phone_number;
        $userName = $user->first_name . ' ' . $user->last_name;
        $email = $user->email;
        $subject = "Appointment Expired - Schedule a New Appointment";
        $rootPath = ROOT;

        $formattedDate = date('F j, Y', strtotime($appointment->appointment_date));
        $formattedTime = date('h:i A', strtotime($appointment->appointment_time));

        $tricycleApplicationModel = new TricycleApplication();
        $tricycleApplicationData = $tricycleApplicationModel->first(['appointment_id' => $appointment->appointment_id]);

        $tricycleCinModel = new TricycleCinNumber();
        $cinData = $tricycleCinModel->first(['tricycle_cin_number_id' => $tricycleApplicationData->tricycle_cin_number_id]);

        if (!empty($cinData)) {
          $tricycleCinModel->update(['cin_number' => $cinData->cin_number], ['is_used' => 0, 'user_id' => null]);
        }

        $cinNumber = $cinData->cin_number;

        $customTextMessage = "Hello {$userName}, \n\nWe would like to inform you that your recent {$appointment->appointment_type} appointment for tricycle CIN #{$cinNumber}, scheduled for {$formattedDate} at {$formattedTime} has expired. We understand that unforeseen circumstances may have arisen, and you can reschedule a new appointment at your earliest convenience.\n\nFor more details, please check our website by clicking the link: {$rootPath}.\n";

        $customEmailMessage = "<div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>I hope this email finds you well. We would like to inform you that your recent {$appointment->appointment_type} appointment for tricycle CIN #{$cinNumber}, scheduled for {$formattedDate} at {$formattedTime} has expired. We understand that unforeseen circumstances may have arisen, and you can reschedule a new appointment at your earliest convenience.</div>";

        systemNotifications($phoneNumber, $userName, $email, $subject, $customTextMessage, $customEmailMessage);
      }
      echo "Expired Approved appointments notifications sent successfully.  "; 
    } else {
      echo "No Expired Approved Appointments.   ";
    }  
  }

  protected function pendingToDeclinedAppointment()
  {
    $currentDate = date('Y-m-d');
    $appointments = new Appointment();
    $query = "UPDATE appointments
          SET status = 'Declined', comments = 
          CASE
            WHEN appointment_date < '{$currentDate}' THEN 'Automatically declined because the appointment date has passed.'
            WHEN appointment_date = '{$currentDate}' THEN 'Automatically declined because the appointment date is today.'
          END
          WHERE status = 'Pending' AND (appointment_date < '{$currentDate}' OR appointment_date = '{$currentDate}')";
  
    // Fetch appointments that are being declined
    $declinedAppointments = $appointments->query($query);
  
    // Send notifications for declined appointments
    if (!empty($declinedAppointments)) {
      foreach ($declinedAppointments as $appointment) {
        $userModel = new User();
        $user = $userModel->first(['user_id' => $appointment->user_id]);
  
        $phoneNumber = $user->phone_number;
        $userName = $user->first_name . ' ' . $user->last_name;
        $email = $user->email;
        $subject = "Appointment Declined";
        $rootPath = ROOT;
  
        $customTextMessage = "Hello {$userName},\n\nWe regret to inform you that your appointment for {$appointment->appointment_type} has been automatically declined. Reason: {$appointment->comments}\n\nFor more details, please check our website by clicking the link: {$rootPath}.\n";
  
        $customEmailMessage = "<div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>We regret to inform you that your appointment for {$appointment->appointment_type} has been automatically declined. Reason: {$appointment->comments}</div>";
  
        systemNotifications($phoneNumber, $userName, $email, $subject, $customTextMessage, $customEmailMessage);
      }
      echo "Declined Appointments Notifications sent successfully.     ";
    } else {
      echo "No Declined Appointments.  ";
    }
  }

  protected function approvedAppointmentReminder()
  {
    $rootPath = ROOT;

    $currentDate = date('Y-m-d');
    $oneDayAhead = date('Y-m-d', strtotime('+1 day'));
    $appointments = new Appointment();

    $query = "SELECT * FROM appointments WHERE status = 'Approved' AND (appointment_date = '{$currentDate}' OR appointment_date = '{$oneDayAhead}')";
    $appointmentsToSendNotifications = $appointments->query($query);

    if (!empty($appointmentsToSendNotifications)){
      foreach ($appointmentsToSendNotifications as $appointment) {
        $userModel = new User();
        $user = $userModel->first(['user_id' => $appointment->user_id]);
  
        $phoneNumber = $user->phone_number;
        $userName = $user->first_name . ' ' . $user->last_name;
        $email = $user->email;
  
        $formattedDate = date('F j, Y', strtotime($appointment->appointment_date));
        $formattedTime = date('h:i A', strtotime($appointment->appointment_time));

        $tricycleApplicationModel = new TricycleApplication();
        $tricycleApplicationData = $tricycleApplicationModel->first(['appointment_id' => $appointment->appointment_id]);

        $tricycleCinModel = new TricycleCinNumber();
        $cinData = $tricycleCinModel->first(['tricycle_cin_number_id' => $tricycleApplicationData->tricycle_cin_number_id]);

        $cinNumber = $cinData->cin_number;
        $routeArea = $tricycleApplicationData->route_area;

        $penaltyFee = ($routeArea === 'Free Zone / Zone 1') ? '122.50' : '272.50';

        $assessmentFee = 0;

        if ($appointment->appointment_type === 'New Franchise' || $appointment->appointment_type === 'Renewal of Franchise' || $appointment->appointment_type === 'Transfer of Ownership') {
          $assessmentFee = ($routeArea === 'Free Zone / Zone 1') ? 430.00 : 1030.00;
        } elseif ($appointment->appointment_type === 'Change of Motorcycle' || $appointment->appointment_type === 'Dropped') {
          $assessmentFee = 60.00;
        }

        // Format the assessment fee with two decimal places
        $assessmentFeeFormatted = number_format($assessmentFee, 2, '.', '');

        $customTextMessage = "Hello {$userName},\n\nYour appointment for {$appointment->appointment_type} with tricycle CIN #{$cinNumber} is scheduled for {$formattedDate} at {$formattedTime}.\n\nTo facilitate your appointment process, kindly note that an assessment fee of ₱{$assessmentFeeFormatted} applies. Please ensure you have the necessary payment prepared for settlement during your appointment.\n\nMoreover, it's crucial to organize and bring all required documents for submission to avoid any delays.\n";

        $customEmailMessage = "<div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>Your appointment for {$appointment->appointment_type} with tricycle CIN #{$cinNumber} is scheduled for {$formattedDate} at {$formattedTime}.</div><div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>To facilitate your appointment process, kindly note that an assessment fee of &#8369;{$assessmentFeeFormatted} applies. Please ensure you have the necessary payment prepared for settlement during your appointment.</div><div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>Moreover, it's crucial to organize and bring all required documents for submission to avoid any delays.</div>";
  
        // Check if the appointment type is "Renewal of Franchise" and the appointment date is past January 20
        if ($appointment->appointment_type === 'Renewal of Franchise' && strtotime($appointment->appointment_date) > strtotime(date('Y-01-20'))) {
          $customTextMessage .= "\nRegrettably, this {$appointment->appointment_type} appointment for tricycle  CIN #{$cinNumber}, with route area {$routeArea}, is now beyond the renewal period of December 20th to January 20th. A penalty of &#8369;{$penaltyFee} is applicable for late renewal.\n\nFor more details, please check our website by clicking the link: {$rootPath}.\n";

          $customEmailMessage .= "<div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>Regrettably, this {$appointment->appointment_type} appointment for tricycle  CIN #{$cinNumber}, with route area {$routeArea}, is now beyond the renewal period of December 20th to January 20th. A penalty of &#8369;{$penaltyFee} is applicable for late renewal.\n</div>";
        } else {
          $customTextMessage .= "\nFor more details, please check our website by clicking the link: {$rootPath}.\n";
        }
  
        $subject = "Appointment Reminder";
  
        systemNotifications($phoneNumber, $userName, $email, $subject, $customTextMessage, $customEmailMessage);
      }
      echo "Approved Appointments Reminders sent successfully.   ";
    } else {
      echo "No Approved Appointments.  ";
    }  
  }
  
}