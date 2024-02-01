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

    $years = $this->getDistinctYears();
    $operators = $this->getDistinctOperators();

    if (empty($years)) {
      $years = [];
    }

    $selectedFilter = isset($_GET['year']) ? $_GET['year'] : (empty($years) ? null : 'all');
    $selectedOperatorName = isset($_GET['operator_name']) ? $_GET['operator_name'] : 'all';

    if ($_SESSION['USER']->role === 'admin') {
      $maintenance_trackers = $this->getMaintenanceDataWithFilters($selectedFilter, $selectedOperatorName);
    } elseif ($_SESSION['USER']->role === 'operator') {
      $maintenance_trackers = $this->getMaintenanceData($selectedFilter);
    }

    $data = [
      'index' => 1,
      'selectedFilter' => $selectedFilter,
      'selectedOperatorName' => $selectedOperatorName,
      'years' => $years,
      'maintenance_trackers' => $maintenance_trackers,
      'operators' => $operators,
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exportCsv'])) {
      $csvData = [];
  
      if ($selectedFilter == 'all') {
        $csvData[] = ['All Maintenance Tracker'];
      } else {
        $csvData[] = ['Maintenance Tracker for the Year ' . $selectedFilter];
      }
  
      $csvHeader = ['Tricycle CIN', 'Driver\'s Name'];
      
      if ($_SESSION['USER']->role !== 'operator') {
        $csvHeader[] = 'Operator\'s Name';
      }
  
      if ($selectedFilter == 'all') {
        $csvHeader[] = 'Total Expenses';
      } else {
        $csvHeader[] = 'Yearly Total Expenses';
      }
  
      $csvData[] = $csvHeader;
  
      foreach ($maintenance_trackers as $maintenance) {
        $rowData = [
          $maintenance->cin_number,
          $maintenance->driver_name,
        ];

        if ($_SESSION['USER']->role !== 'operator') {
          $rowData[] = $maintenance->operator_name;
        }

        $rowData[] = $maintenance->yearly_total_expenses;

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

  private function getMaintenanceDataWithFilters($selectedYear, $selectedOperatorName)
  {
    $maintenanceLog = new MaintenanceLog();
    return $maintenanceLog->getMaintenanceDataWithFilters($selectedYear, $selectedOperatorName);
  }

  private function getDistinctOperators()
  {
    $maintenanceLog = new MaintenanceLog();
    return $maintenanceLog->distinctOperators();
  }
}