<?php

class Appointment_status_automation
{
  use Controller;

  public function index()
  {
    // Update appointments with status 'Approved' and appointment date 1 week past
    $this->updateApprovedAppointments();

    // Update appointments with status 'Pending' and appointment date 1 month past
    $this->updatePendingAppointments();

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
}
