<?php

class Maintenance_logs
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }

    // Check if the user has the "operator" role
		$userRole = $_SESSION['USER']->role;
		if ($userRole !== 'operator') {
			set_flash_message("Access denied. You don't have the required role.", "error");
			redirect('');
		}

    $selectedFilter = isset($_GET['driver_name']) ? $_GET['driver_name'] : 'all';
		
    $maintenanceLogModel = new MaintenanceLog();
    $tricycleCinModel = new TricycleCinNumber();
    $driverModel = new Driver();
    
    $driversData = $driverModel->where(['user_id' => $_SESSION['USER']->user_id]);
    $driverNames = [];

    foreach ($driversData as $driver) {
      $fullName = $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name;
      $driverNames[$driver->driver_id] = $fullName;
    }

    $data['maintenance_logs'] = [];
    $data['index'] = 1;
    $data['selectedFilter'] = $selectedFilter;
    $data['drivers'] = $driverNames;

    if ($selectedFilter === 'all') {
      $maintenanceLogData = $maintenanceLogModel->where(['user_id' => $_SESSION['USER']->user_id]);
    } else {
      $driverId = array_search($selectedFilter, $driverNames);
      if ($driverId !== false) {
        $maintenanceLogData = $maintenanceLogModel->where(['user_id' => $_SESSION['USER']->user_id, 'driver_id' => $driverId]);
      } else {
        $maintenanceLogData = [];
      }
    }

    if (!empty($maintenanceLogData)) {
      foreach ($maintenanceLogData as $maintenance) {
        $driver = $driverModel->first(['driver_id' => $maintenance->driver_id]);
        $driverName = $driver ? $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name : '----------------';

        $cin = $tricycleCinModel->first(['tricycle_cin_number_id' => $maintenance->tricycle_cin_number_id]);
        $cin_number = $cin ? $cin->cin_number : '----------------';

        $data['maintenance_logs'][] = [
					'maintenance_log_id' => $maintenance->maintenance_log_id,
          'cin' => $cin_number,
          'driver_name' => $driverName,
          'expense_date' => date('F d, Y h:i A', strtotime($maintenance->expense_date)),
          'total_expenses' => $maintenance->total_expenses,
          'description' => $maintenance->description
        ];
      }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exportCsv'])) {
      $csvData = [];
      $csvData[] = ['Maintenance Logs'];
      $csvData[] = ['Tricycle CIN', "Driver's Name", 'Date', 'Total Expenses', 'Description'];

      foreach ($data['maintenance_logs'] as $maintenance) {
          $csvData[] = [
              $maintenance['cin'],
              $maintenance['driver_name'],
              $maintenance['expense_date'],
              $maintenance['total_expenses'],
              $maintenance['description']
          ];
      }

      downloadCsv($csvData, 'Maintenance_Logs_Export');
    }

    echo $this->renderView('maintenance_logs', true, $data);
  }
}