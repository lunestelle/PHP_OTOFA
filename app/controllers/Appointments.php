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
    $startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
    $endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';

    $appointmentModel = new Appointment();
    $userModel = new User();

    if ($_SESSION['USER']->role === 'admin') {
      $appointmentsData = $appointmentModel->getAppointmentsByDateRange($statusFilter, $startDate, $endDate);
    } else {
      $whereConditions = ['user_id' => $_SESSION['USER']->user_id];
      if ($statusFilter === 'pending') {
        $whereConditions['status'] = 'Pending';
      }
      $appointmentsData = $appointmentModel->getAppointmentsByDateRange($statusFilter, $startDate, $endDate, $whereConditions);
    }

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
          'transfer_type' => $appointment->transfer_type,
          'appointment_date' => $appointment->appointment_date,
          'appointment_time' => $formattedAppointmentTime,
          'status' => $appointment->status
        ];
      }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
      if (isset($_POST['exportCsv'])) {
        $csvData = [];
        
        $startDate = isset($_GET['startDate']) ? date('F j, Y', strtotime($_GET['startDate'])) : null;
        $endDate = isset($_GET['endDate']) ? date('F j, Y', strtotime($_GET['endDate'])) : null;
    
        // CSV file name based on the presence of start and end dates
        $csvFileName = 'Appointments';
        if ($startDate && $endDate) {
          $csvFileName .= " from $startDate to $endDate";
        }
    
        $csvData[] = [$csvFileName];
        $csvData[] = ['Name', 'Phone Number', 'Email', 'Appointment Type', 'Transfer Type', 'Appointment Date', 'Appointment Time', 'Status'];
    
        foreach ($data['appointments'] as $appointment) {
          $csvData[] = [
            $appointment['name'],
            $appointment['phone_number'],
            $appointment['email'],
            $appointment['appointment_type'],
            $appointment['transfer_type'],
            $appointment['appointment_date'],
            $appointment['appointment_time'],
            $appointment['status'],
          ];
        }
    
        downloadCsv($csvData, $csvFileName . '_Export');
      } elseif (isset($_POST['newAppointment'])){
        $userData = $userModel->first(['user_id' => $_SESSION['USER']->user_id]);
    
        if ($userData && $userData->phone_number_status === 'Verified') {
          redirect("new_appointment");
        } else {
          set_flash_message("Sorry, you need to verify your phone number before <br> setting an appointment. Please verify your phone <br> number in the Manage Account page.", "error");
          redirect("manage_account");
        }
      }
    }
    

    echo $this->renderView('appointments', true, $data);
  }
}