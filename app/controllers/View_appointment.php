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
    $appointmentData = $appointmentModel->first(['appointment_id' => $appointment_id]);
    $appointment_time = formatTime($appointmentData->appointment_time);

    $tricycleApplicationModel = new TricycleApplication();
    $tricyleApplicationData = $tricycleApplicationModel->first(['appointment_id' => $appointmentData->appointment_id]);


    if (!$appointmentData) {
      set_flash_message("Appointment not found.", "error");
      redirect('appointments');
    }

    $data = [
      'appointment' => $appointmentData,
      'appointment_time' => $appointment_time,
      'tricycleApplication' => $tricyleApplicationData
    ];
    echo $this->renderView('view_appointment', true, $data);
  }
}