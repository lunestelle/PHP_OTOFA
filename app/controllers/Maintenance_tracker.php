<?php

class Maintenance_tracker
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }

    // Get the list of years for the filter dropdown
    $years = $this->getDistinctYears();

    if (empty($years)) {
      // Handle the case where $years is empty or null
      $years = []; // Set a default value, an empty array in this case
    }

    $selectedFilter = isset($_GET['year']) ? $_GET['year'] : (empty($years) ? null : 'all');
    $maintenance_trackers = $this->getMaintenanceData($selectedFilter);

    $data = [
      'index' => 1,
      'selectedFilter' => $selectedFilter,
      'years' => $years,
      'maintenance_trackers' => $maintenance_trackers,
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exportCsv'])) {
      $csvData = [];

      if ($selectedFilter == 'all') {
        $csvData[] = ['All Maintenance Tracker'];
      } else {
        $csvData[] = ['Maintenance Tracker for the Year ' . $selectedFilter];
      }

      $csvData[] = ['Tricycle CIN', 'Operator\'s Name', 'Driver\'s Name'];

      if ($selectedFilter == 'all') {
        $csvData[1][] = 'Total Expenses';
      } else {
        $csvData[1][] = 'Yearly Total Expenses';
      }

      foreach ($maintenance_trackers as $maintenance) {
        $rowData = [
          $maintenance->cin_number,
          $maintenance->operator_name,
          $maintenance->driver_name,
          $maintenance->yearly_total_expenses,
        ];

        $csvData[] = $rowData;
      }

      downloadCsv($csvData, 'Maintenance_Tracker_Export');
    }


    echo $this->renderView('maintenance_tracker', true, $data);
  }

  private function getDistinctYears()
  {
    $maintenanceLog = new MaintenanceLog();
    return $maintenanceLog->distinctYears();
  }

  private function getMaintenanceData($selectedYear)
  {
    $maintenanceLog = new MaintenanceLog();
    return $maintenanceLog->getMaintenanceData($selectedYear);
  }
}