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

    // Define the required permissions for accessing the edit user page
    $requiredPermissions = [
      "Can view appointments reports"
    ];

    // Check if the logged-in user has any of the required permissions
    $userPermissions = isset($_SESSION['USER']->permissions) ? explode(', ', $_SESSION['USER']->permissions) : [];
    if (!hasAnyPermission($requiredPermissions, $userPermissions)) {
      set_flash_message("Access denied. You don't have the required permissions.", "error");
      redirect('');
    }

    $appointmentModel = new Appointment();
    $userModel = new User();

    $operatorsData = $userModel->where(['role' => 'operator']);

    $data['index'] = 1;

    // Retrieve unique years from the appointment dates
    $years = $appointmentModel->getUniqueYears();
    if (empty($years)) {
      // Handle the case where $years is empty or null
      $years = []; // Set a default value, an empty array in this case
    }

    $selectedYear = isset($_GET['year']) ? $_GET['year'] : (empty($years) ? null : 'all');

    // Retrieve appointments reports based on the selected year
    $appointmentsReportsData = $appointmentModel->getAppointmentsReports($selectedYear);

    if (!empty($appointmentsReportsData)) {
      foreach ($appointmentsReportsData as $report) {
        $data['appointmentsReports'][] = [
          'user_id' => $report->user_id,
          'operator_name' => $report->first_name . ' ' . $report->last_name,
          'phone_number' => $report->phone_number,
          'total_appointments' => $report->total_appointments,
          'pending_appointments' => $report->pending_appointments,
          'completed_appointments' => $report->completed_appointments,
          'approved_appointments' => $report->approved_appointments,
          'rejected_appointments' => $report->rejected_appointments,
          'on_process_appointments' => $report->on_process_appointments,
          'year' => $report->year,
        ];
      }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exportCsv'])) {
      $csvData = [];
  
      if ($selectedYear == 'all') {
        $csvData[] = ['All Appointments Reports'];
      } else {
        $csvData[] = ['Appointments Reports for the Year ' . $selectedYear];
      }
  
      $csvData[] = ['Operator\'s Name', 'Phone Number', 'Total Appointments', 'Pending Appointments', 'Completed Appointments', 'Approved Appointments', 'Rejected Appointments', 'On Process Appointments'];
  
      // Add "Appointment Year" column header only if the filter is 'all'
      if ($selectedYear == 'all') {
        $csvData[1][] = 'Appointment Year';
      }
  
      foreach ($appointmentsReportsData as $report) {
        $rowData = [
          $report->first_name . ' ' . $report->last_name,
          $report->phone_number,
          $report->total_appointments,
          $report->pending_appointments,
          $report->completed_appointments,
          $report->approved_appointments,
          $report->rejected_appointments,
          $report->on_process_appointments,
        ];

        if ($selectedYear == 'all') {
          $rowData[] = $report->year;
        }

        $csvData[] = $rowData;
      }
  
      downloadCsv($csvData, 'Appointments_Reports_Export');
    }

    $data['years'] = $years;
    $data['selectedFilter'] = $selectedYear;

    echo $this->renderView('appointments_reports', true, $data);
  }
}