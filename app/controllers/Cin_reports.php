<?php

class Cin_reports
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
      redirect('');
    }

    $tricycleModel = new TricycleCinNumber();
    $userModel = new User();
    $usedCINs = $tricycleModel->where(['is_used' => true]);

    $usedCINs = is_array($usedCINs) ? $usedCINs : [];

    if (!empty($usedCINs)) {
      usort($usedCINs, function ($a, $b) {
        return $a->cin_number <=> $b->cin_number;
      });
    }

    $data['cinReports'] = [];
    $data['index'] = 1;

    if (!empty($usedCINs)) {
      $groupedData = [];
      foreach ($usedCINs as $usedCIN) {
        $userId = $usedCIN->user_id;
        $user = $userModel->first(['user_id' => $userId]);
        $userName = $user ? $user->first_name . ' ' . $user->last_name : 'N/A';

        if (!isset($groupedData[$userId])) {
          $groupedData[$userId] = [
            'user_name' => $userName,
            'cin_numbers' => [],
          ];
        }

        $groupedData[$userId]['cin_numbers'][] = $usedCIN->cin_number;
      }

      foreach ($groupedData as $userId => $userData) {
        $totalAvailableCINs = $tricycleModel->count(['is_used' => false]);
        $totalUsedCINs = $tricycleModel->count(['is_used' => true]);

        $data['cinReports'][] = [
          'index' => $data['index']++,
          'user_name' => $userData['user_name'],
          'cin_numbers_owned' => implode(', ', $userData['cin_numbers']),
          'total_available_cin_numbers' => $totalAvailableCINs,
          'total_used_cin_numbers' => $totalUsedCINs,
        ];
      }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exportCsv'])) {
      $csvData = [];
      $csvData[] = ['CIN Reports'];
      $csvData[] = ['Total of Available CIN Numbers: ' . $totalAvailableCINs];
      $csvData[] = ['Total of Used CIN Numbers: ' . $totalUsedCINs];
      $csvData[] = ['User', 'CIN Numbers Owned'];
      foreach ($data['cinReports'] as $report) {
        $csvData[] = [
          $report['user_name'],
          $report['cin_numbers_owned'],
        ];
      }

      downloadCsv($csvData, 'CIN_Reports_Export');
    }

    echo $this->renderView('cin_reports', true, $data);
  }
}