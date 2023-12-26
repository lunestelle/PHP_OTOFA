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

    $data['appointmentsReports'] = [];
    $data['index'] = 1;

    if (!empty($operatorsData)) {
      foreach ($operatorsData as $operator) {
        $totalAppointments = $appointmentModel->count(['user_id' => $operator->user_id]);
        $pendingAppointments = $appointmentModel->count(['user_id' => $operator->user_id, 'status' => 'Pending']);
        $completedAppointments = $appointmentModel->count(['user_id' => $operator->user_id, 'status' => 'Completed']);

        $data['appointmentsReports'][] = [
          'operator_name' => $operator->first_name . ' ' . $operator->last_name,
          'email' => $operator->email,
          'phone_number' => $operator->phone_number,
          'total_appointments' => $totalAppointments,
          'pending_appointments' => $pendingAppointments,
          'completed_appointments' => $completedAppointments,
        ];
      }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exportCsv'])) {
      $csvData = [];
      $csvData[] = ['Appointments Reports'];
      $csvData[] = ['Operator\'s Name', 'Email', 'Phone Number', 'Pending Appointments', 'Completed Appointments'];

      foreach ($data['appointmentsReports'] as $report) {
        $csvData[] = [
          $report['operator_name'],
          $report['email'],
          $report['phone_number'],
          $report['total_appointments'],
          $report['pending_appointments'],
          $report['completed_appointments'],
        ];
      }

      downloadCsv($csvData, 'Appointments_Reports_Export');
    }

    echo $this->renderView('appointments_reports', true, $data);
  }
}