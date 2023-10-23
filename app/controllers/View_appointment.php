<?php

class View_appointment
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }

    $appointment_id = $_GET['appointment_id'];
    $appointmentModel = new Appointment();
    $appointment = $appointmentModel->first(['appointment_id' => $appointment_id]);
    $appointment_time = formatTime($appointment->appointment_time);


    if (!$appointment) {
      set_flash_message("Appointment not found.", "error");
      redirect('appointments');
    }

    $data = [
      'appointment' => $appointment,
      'appointment_time' => $appointment_time
    ];
    echo $this->renderView('view_appointment', true, $data);
  }
}