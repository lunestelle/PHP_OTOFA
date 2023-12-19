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
		
    $maintenanceLogModel = new MaintenanceLog();
    $maintenanceLogData = $maintenanceLogModel->where(['user_id' => $_SESSION['USER']->user_id]);

    $tricycleCinModel = new TricycleCinNumber();
    $tricycleCinData = $tricycleCinModel->findAll();

    $driverModel = new Driver();
    $driversData = $driverModel->findAll();

    $data['maintenance_logs'] = [];
    $data['index'] = 1;

    if (!empty($maintenanceLogData)) {
      foreach ($maintenanceLogData as $maintenance) {
        $cin = '';
        $driverName = '';

        if (!empty($tricycleCinData)) {
          foreach ($tricycleCinData as $tricycle) {
            if ($maintenance->tricycle_cin_number_id === $tricycle->tricycle_cin_number_id) {
              $cin = $tricycle->cin_number;
              break;
            }
          }
        }

        if (!empty($driversData)) {
          foreach ($driversData as $driver) {
            if ($maintenance->driver_id == $driver->driver_id) {
              $driverName = $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name;
              break;
            }
          }
        }

        $data['maintenance_logs'][] = [
					'maintenance_log_id' => $maintenance->maintenance_log_id,
          'cin' => $cin,
          'driver_name' => $driverName,
          'expense_date' => date('F d, Y h:i A', strtotime($maintenance->expense_date)),
          'total_expenses' => $maintenance->total_expenses,
          'description' => $maintenance->description
        ];
      }
    }

    echo $this->renderView('maintenance_logs', true, $data);
  }
}