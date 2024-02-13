<?php

class Display_calendar
{
  use Controller;

  public function index()
  {
    $appointmentModel = new Appointment();
    $slotsData = [];

    // Get appointments for the next 15 days including today
    $startDate = date('Y-m-d');
    $endDate = date('Y-m-d', strtotime('+15 days'));

    // Initialize data array
    $data_arr = [];
    $i = 1;

    while ($startDate <= $endDate) {
      $pendingAppointment = $appointmentModel->count(['appointment_date' => $startDate, 'status' => 'Pending']);
      $approvedAppointment = $appointmentModel->count(['appointment_date' => $startDate, 'status' => 'Approved']);

      $totalAppointment = $pendingAppointment + $approvedAppointment;

      $availableAppointmentsLeft = 100 - $totalAppointment;

      // Define spots left message
      if ($availableAppointmentsLeft > 1) {
        $spotsLeftMessage = "Spots Left: $availableAppointmentsLeft";
      } elseif ($availableAppointmentsLeft === 1) {
        $spotsLeftMessage = "Spot Left: 1";
      } else {
        $spotsLeftMessage = "No Spot Left";
      }

      // Generate random color
      $color = '#' . substr(uniqid(), -6);

      $data_arr[] = [
        'title' => $spotsLeftMessage,
        'start' => $startDate,
        'color' => $color
      ];

      // Move to the next date
      $startDate = date('Y-m-d', strtotime($startDate . ' +1 day'));
    }

    $data = [
      'status' => true,
      'msg' => 'successfully!',
      'data' => $data_arr
    ];

    echo json_encode($data);
  }
}