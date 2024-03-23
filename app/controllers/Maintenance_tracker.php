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

    // Define the required permissions for accessing the edit user page
    $requiredPermissions = [
      "Can view maintenance tracker"
    ];

    // Check if the logged-in user has the required permissions, unless they are an operator
    $userPermissions = isset($_SESSION['USER']->permissions) ? explode(', ', $_SESSION['USER']->permissions) : [];
    $userRole = isset($_SESSION['USER']->role) ? $_SESSION['USER']->role : '';
    if (!hasAnyPermission($requiredPermissions, $userPermissions) && $userRole !== 'operator') {
      set_flash_message("Access denied. You don't have the required permissions.", "error");
      redirect('');
    }

    $years = $this->getDistinctYears();
    $operators = $this->getDistinctOperators();

    if (empty($years)) {
      $years = [];
    }

    $selectedFilter = isset($_GET['year']) ? $_GET['year'] : (empty($years) ? null : 'all');
    $selectedOperatorName = isset($_GET['operator_name']) ? $_GET['operator_name'] : 'all';

    // Check if the logged-in user has any of the required permissions
    $userPermissions = isset($_SESSION['USER']->permissions) ? explode(', ', $_SESSION['USER']->permissions) : [];
    if (hasAnyPermission($requiredPermissions, $userPermissions)) {
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