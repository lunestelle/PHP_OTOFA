<?php

class Cancel_appointment
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to perform this action.", "error");
      redirect('');
    }

    $appointment_id = isset($_GET['appointment_id']) ? $_GET['appointment_id'] : null;
    $appointmentModel = new Appointment();
    $appointment = $appointmentModel->first(['appointment_id' => $appointment_id]);

    if (!$appointment) {
      set_flash_message("Appointment not found.", "error");
      redirect('appointments');
    }

    // Check if the appointment can be canceled based on your cancelation policy.
    if (!$appointmentModel->canBeCanceled($appointment_id)) {
      set_flash_message("Sorry, this appointment cannot be <br> canceled at this time.", "error");
      redirect('appointments');
    } else {
      $appointmentModel->update(['appointment_id' => $appointment_id], ['status' => 'Cancelled']);
      set_flash_message("Appointment successfully canceled.", "success");
      redirect('appointments');
    }
  }
}
