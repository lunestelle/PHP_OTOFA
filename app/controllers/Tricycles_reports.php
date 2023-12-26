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

    $tricycleModel = new Tricycle();
    $userModel = new User();

    // Fetch operators and their tricycles
    $operatorsData = $userModel->where(['role' => 'operator']);

    $data['tricycleReports'] = [];
    $data['index'] = 1;

    if (!empty($operatorsData)) {
      foreach ($operatorsData as $operator) {
        $totalTricycles = $tricycleModel->count(['user_id' => $operator->user_id]);
  
        if ($totalTricycles > 0) {
          $activeTricycles = $tricycleModel->count(['user_id' => $operator->user_id, 'status' => 'Active']);
          $droppedTricycles = $tricycleModel->count(['user_id' => $operator->user_id, 'status' => 'Dropped']);
          $renewalRequiredTricycles = $tricycleModel->count(['user_id' => $operator->user_id, 'status' => 'Renewal Required']);
          $changeMotorRequiredTricycles = $tricycleModel->count(['user_id' => $operator->user_id, 'status' => 'Change Motor Required']);
  
  
          $data['tricycleReports'][] = [
            'operator_name' => $operator->first_name . ' ' . $operator->last_name,
            'total_tricycles' => $totalTricycles,
            'active_tricycles' => $activeTricycles,
            'dropped_tricycles' => $droppedTricycles,
            'renewal_required_tricycles' => $renewalRequiredTricycles,
            'change_motor_required_tricycles' => $changeMotorRequiredTricycles,
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