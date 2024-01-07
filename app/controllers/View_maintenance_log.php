<?php

class View_maintenance_log
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

    $maintenanceLogId = isset($_GET['maintenance_log_id']) ? $_GET['maintenance_log_id'] : null;

    $maintenanceLogModel = new MaintenanceLog();
    $maintenanceLogData = $maintenanceLogModel->first(['maintenance_log_id' => $maintenanceLogId]);

    $tricycleCinModel = new TricycleCinNumber();
    $tricycleCinData = $tricycleCinModel->first(['tricycle_cin_number_id' => $maintenanceLogData->tricycle_cin_number_id]);
    $tricyclePlateNumber = $tricycleCinData !== false ? $tricycleCinData->cin_number : '';
    
    $driverModel = new Driver();
    $driverData = $driverModel->first(['driver_id' => $maintenanceLogData->driver_id]);
    $driverName = $driverData !== false ? $driverData->first_name . ' ' . $driverData->middle_name . ' ' . $driverData->last_name : '';
    
    if (!$maintenanceLogData) {
      set_flash_message("maintenanceLog not found.", "error");
      redirect('maintenanceLogs');
    }

    $data = [
      'cin' => $tricyclePlateNumber,
      'driver_name' => $driverName,
      'expense_date' => date('F d, Y h:i A', strtotime($maintenanceLogData->expense_date)),
      'total_expenses' => $maintenanceLogData->total_expenses,
      'description' => $maintenanceLogData->description,
      'expenses_receipt_image_path' => $maintenanceLogData->expenses_receipt_image_path
    ];

    echo $this->renderView('view_maintenance_log', true, $data);
  }
}
