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

    $statusFilter = isset($_GET['status']) ? $_GET['status'] : '';

    $appointmentModel = new Appointment();

    if ($_SESSION['USER']->role === 'admin') {
      // Fetch all tricycles data for Admin
      $appointmentsData = $statusFilter !== 'pending' ? $appointmentModel->findAll() : $appointmentModel->where(['status' => 'Pending']);
    } else {
      // Fetch tricycles data based on the user ID for non-Admin users
      $whereConditions = ['user_id' => $_SESSION['USER']->user_id];
      if ($statusFilter === 'pending') {
        $whereConditions['status'] = 'Pending';
      }
      $appointmentsData = $appointmentModel->where($whereConditions);
    }

    $data['appointments'] = [];
    $data['index'] = 1;
    // $appointment = [];

    if (!empty($appointmentsData)) {
      foreach ($appointmentsData as $appointment) {
        $formattedAppointmentTime = formatTime($appointment->appointment_time);
  
        $data['appointments'][] = [
          'appointment_id' => $appointment->appointment_id,
          'name' => $appointment->name,
          'phone_number' => $appointment->phone_number,
          'email' => $appointment->email,
          'appointment_type' => $appointment->appointment_type,
          'transfer_type' => $appointment->transfer_type,
          'appointment_date' => $appointment->appointment_date,
          'appointment_time' => $formattedAppointmentTime,
          'status' => $appointment->status
        ];
      }
    }

    echo $this->renderView('appointments', true, $data);
  }
}
