<?php

class Tricycles_reports
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
      redirect('');
    }

    // Define the required permissions for accessing the edit user page
    $requiredPermissions = [
      "Can view tricycles reports"
    ];

    // Check if the logged-in user has any of the required permissions
    $userPermissions = isset($_SESSION['USER']->permissions) ? explode(', ', $_SESSION['USER']->permissions) : [];
    if (!hasAnyPermission($requiredPermissions, $userPermissions)) {
      set_flash_message("Access denied. You don't have the required permissions.", "error");
      redirect('');
    }

    $tricycleModel = new Tricycle();
    $tricycleStatusesModel = new TricycleStatuses;
    $userModel = new User();

    // Fetch operators and their tricycles
    $operatorsData = $userModel->where(['role' => 'operator']);

    $data['tricycleReports'] = [];
    $data['index'] = 1;

    if (!empty($operatorsData)) {
      foreach ($operatorsData as $operator) {
        $totalTricycles = $tricycleStatusesModel->count(['user_id' => $operator->user_id]);
  
        if ($totalTricycles > 0) {
          $activeTricycles = $tricycleStatusesModel->count(['user_id' => $operator->user_id, 'status' => 'Active']);
          $droppedTricycles = $tricycleStatusesModel->count(['user_id' => $operator->user_id, 'status' => 'Dropped']);
          $renewalRequiredTricycles = $tricycleStatusesModel->count(['user_id' => $operator->user_id, 'status' => 'Renewal Required']);
          $changeMotorRequiredTricycles = $tricycleStatusesModel->count(['user_id' => $operator->user_id, 'status' => 'Change Motor Required']);
          $expiredRenewalTricycles = $tricycleStatusesModel->countWithPattern(['user_id' => $operator->user_id, 'status' => 'Expired Renewal%']);
          $expiredMotorTricycles = $tricycleStatusesModel->countWithPattern(['user_id' => $operator->user_id, 'status' => 'Expired Motor%']);

          $data['tricycleReports'][] = [
            'user_id' => $operator->user_id,
            'operator_name' => $operator->first_name . ' ' . $operator->last_name,
            'total_tricycles' => $totalTricycles,
            'active_tricycles' => $activeTricycles,
            'dropped_tricycles' => $droppedTricycles,
            'renewal_required_tricycles' => $renewalRequiredTricycles,
            'change_motor_required_tricycles' => $changeMotorRequiredTricycles,
            'expired_renewal_tricycles' => $expiredRenewalTricycles,
            'expired_motor_tricycles' => $expiredMotorTricycles,
          ];
        }
      }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exportCsv'])) {
      $csvData = [];
      $csvData[] = ['Tricycle Reports'];
      $csvData[] = ['Operator\'s Name', 'Total Tricycles', 'Active Tricycles', 'Dropped Tricycles', 'Renewal Required Tricycles', 'Change Motor Required Tricycles'];

      foreach ($data['tricycleReports'] as $report) {
        $csvData[] = [
          $report['operator_name'],
          $report['total_tricycles'],
          $report['active_tricycles'],
          $report['dropped_tricycles'],
          $report['renewal_required_tricycles'],
          $report['change_motor_required_tricycles'],
        ];
      }

      downloadCsv($csvData, 'Tricycle_Reports_Export');
    }

    echo $this->renderView('tricycles_reports', true, $data);
  }
}