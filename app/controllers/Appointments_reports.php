<?php

class Appointments_reports
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }

    $appointmentModel = new Appointment();
    $userModel = new User();

    // Fetch operators and their appointments reports
    $operatorsData = $userModel->where(['role' => 'operator']);

    $data['index'] = 1;

    // Retrieve unique years from the appointment dates
    $uniqueYears = $appointmentModel->getUniqueYears();

    // Set the default selected year
    $selectedYear = isset($_GET['year']) ? $_GET['year'] : $uniqueYears[0];

    // Retrieve appointments reports based on the selected year
    $appointmentsReportsData = $appointmentModel->getAppointmentsReports($selectedYear);

    if (!empty($appointmentsReportsData)) {
      foreach ($appointmentsReportsData as $report) {
        $data['appointmentsReports'][] = [
          'operator_name' => $report->first_name . ' ' . $report->last_name,
          'phone_number' => $report->phone_number,
          'total_appointments' => $report->total_appointments,
          'pending_appointments' => $report->pending_appointments,
          'completed_appointments' => $report->completed_appointments,
        ];
      }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exportCsv'])) {
      $csvData = [];
      $csvData[] = ['Appointments Reports for Year ' . $selectedYear];
      $csvData[] = ['Operator\'s Name', 'Phone Number', 'Total Appointments', 'Pending Appointments', 'Completed Appointments'];
  
      foreach ($appointmentsReportsData as $report) {
        $csvData[] = [
          $report->first_name . ' ' . $report->last_name,
          $report->phone_number,
          $report->total_appointments,
          $report->pending_appointments,
          $report->completed_appointments,
        ];
      }
  
      downloadCsv($csvData, 'Appointments_Reports_Export');
    }

    $data['years'] = $uniqueYears;
    $data['selectedFilter'] = $selectedYear;

    echo $this->renderView('appointments_reports', true, $data);
  }
}