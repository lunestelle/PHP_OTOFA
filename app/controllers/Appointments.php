<?php

class Appointments
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
      redirect('');
    }

    $appointmentModel = new Appointment();
    $appointmentsData = $appointmentModel->where(['user_id' => $_SESSION['USER']->user_id]);

    $data['appointments'] = [];
    $data['index'] = 1;

    if (!empty($appointmentsData)) {
      foreach ($appointmentsData as $appointment) {
        $formattedAppointmentTime = formatTime($appointment->appointment_time);
  
        $data['appointments'][] = [
          'appointment_id' => $appointment->appointment_id,
          'name' => $appointment->name,
          'phone_number' => $appointment->phone_number,
          'email' => $appointment->email,
          'appointment_type' => $appointment->appointment_type,
          'appointment_date' => $appointment->appointment_date,
          'appointment_time' => $formattedAppointmentTime,
          'status' => $appointment->status
        ];
      }
    }

    echo $this->renderView('appointments', true, $data);
  }
}
