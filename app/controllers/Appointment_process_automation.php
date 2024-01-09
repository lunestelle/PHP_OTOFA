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

    echo "Appointment status automation completed.";
  }

  protected function updateApprovedAppointments()
  {
    $oneWeekAgo = date('Y-m-d', strtotime('-1 week'));
    $appointments = new Appointment();
    $query = "UPDATE appointments
            SET status = 'Rejected', comments = 'User Failed to show on the set approved appointment.'
            WHERE status = 'Approved' AND appointment_date <= '{$oneWeekAgo}'";
    $appointments->query($query);
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

    foreach ($appointmentsToSendNotifications as $appointment) {
      $userModel = new User();
      $user = $userModel->first(['user_id' => $appointment->user_id]);

      $phoneNumber = $user->phone_number;
      $userName = $user->first_name . ' ' . $user->last_name;
      $email = $user->email;

      $formattedDate = date('F j, Y', strtotime($appointment->appointment_date));
      $formattedTime = date('h:i A', strtotime($appointment->appointment_time));

      $customTextMessage = "Dear {$userName}, Your appointment is scheduled for {$formattedDate} at {$formattedTime}. Please ensure that you are prepared for the appointment.";

      $customEmailMessage = "Your appointment is scheduled for {$formattedDate} at {$formattedTime}. Please ensure that you are prepared for the appointment.";

      $subject = "Appointment Reminder";

      systemNotifications($phoneNumber, $userName, $email, $subject, $customTextMessage, $customEmailMessage);
    }
  }
}
