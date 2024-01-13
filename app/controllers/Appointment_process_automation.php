<?php

class Appointment_process_automation
{
  use Controller;

  public function index()
  {
    // Update appointments with status 'Approved' and appointment date 1 week past
    $this->updateApprovedAppointments();

    // Update appointments with status 'Pending' and appointment date 1 month past
    $this->updatePendingAppointments();

    // Send notifications for appointments a day before and on the day of the appointment
    $this->sendAppointmentNotifications();

    echo "Appointment status automation completed. <br>";
  }

  protected function updateApprovedAppointments()
  {
    $oneWeekAgo = date('Y-m-d', strtotime('-1 week'));
    $appointments = new Appointment();
    $query = "SELECT * FROM appointments
              WHERE status = 'Approved' AND appointment_date <= '{$oneWeekAgo}'";
    $appointmentsToUpdate = $appointments->query($query);

    if (!empty($appointmentsToUpdate)) {
      foreach ($appointmentsToUpdate as $appointment) {
        $query = "UPDATE appointments
                  SET status = 'Rejected', comments = 'User Failed to show on the set approved appointment.'
                  WHERE appointment_id = {$appointment->appointment_id}";
        $appointments->query($query);

        $userModel = new User();
        $user = $userModel->first(['user_id' => $appointment->user_id]);
        $phoneNumber = $user->phone_number;
        $userName = $user->first_name . ' ' . $user->last_name;
        $email = $user->email;
        $subject = "Appointment Expired - Schedule a New Appointment";

        $formattedDate = date('F j, Y', strtotime($appointment->appointment_date));
        $formattedTime = date('h:i A', strtotime($appointment->appointment_time));

        $customTextMessage = "Hello {$userName}, \n\nWe would like to inform you that your recent appointment, scheduled for {$formattedDate} at {$formattedTime} has expired. We understand that unforeseen circumstances may have arisen, and you can reschedule a new appointment at your earliest convenience.\n\nThank you.";

        $customEmailMessage = "<div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>I hope this email finds you well. We would like to inform you that your recent appointment, scheduled for {$formattedDate} at {$formattedTime} has expired. We understand that unforeseen circumstances may have arisen, and you can reschedule a new appointment at your earliest convenience.</div>";

        systemNotifications($phoneNumber, $userName, $email, $subject, $customTextMessage, $customEmailMessage);
      }
      echo "Expired Approved appointments notifications sent successfully."; 
    }   
  }

  protected function updatePendingAppointments()
  {
    $oneMonthAgo = date('Y-m-d', strtotime('-1 month'));
    $appointments = new Appointment();
    $query = "UPDATE appointments
            SET status = 'Rejected', comments = 'Automatically rejected because the appointment date has passed.'
            WHERE status = 'Pending' AND appointment_date <= '{$oneMonthAgo}'";
    $appointments->query($query);
  }

  protected function sendAppointmentNotifications()
  {
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
  
        $customTextMessage = "Hello {$userName},\n\nYour appointment is scheduled for {$formattedDate} at {$formattedTime}. Please ensure that you are prepared for the appointment.\n";
  
        $customEmailMessage = "<div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>Your appointment is scheduled for {$formattedDate} at {$formattedTime}. Please ensure that you are prepared for the appointment.</div>";
  
        // Check if the appointment type is "Renewal of Franchise" and the appointment date is past January 20
        if ($appointment->appointment_type === 'Renewal of Franchise' && strtotime($appointment->appointment_date) > strtotime(date('Y-01-20'))) {
          $customTextMessage .= "\n\nPlease be informed that your appointment is past the renewal period for the tricycle franchise, which is from December 20 to January 20. Please be aware that a penalty of ₱150.00 is applicable due to late renewal.\n";
          $customEmailMessage .= "<div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>Please be informed that your appointment is past the renewal period for the tricycle franchise, which is from December 20 to January 20. Please be aware that a penalty of ₱150.00 is applicable due to late renewal.</div>";
        }
  
        $subject = "Appointment Reminder";
  
        systemNotifications($phoneNumber, $userName, $email, $subject, $customTextMessage, $customEmailMessage);
      }
      echo "<br>Approved Appointments Reminders sent successfully. <br>";
    }
  }
}