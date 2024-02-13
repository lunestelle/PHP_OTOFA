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

      // Generate pastel color
      $color = $this->generatePastelColor();

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

  private function generatePastelColor() {
    $red = mt_rand(100, 255);
    $green = mt_rand(100, 255);
    $blue = mt_rand(100, 255);
    return sprintf('#%02x%02x%02x', $red, $green, $blue);
  }
}