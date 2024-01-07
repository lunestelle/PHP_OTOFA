<?php

class New_maintenance_log
{
	use Controller;

	public function index()
	{
    if (!is_authenticated()) {
			set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
			redirect('');
		}

    $tricycleCinModel = new TricycleCinNumber();
    $tricycleCinNumbers = $tricycleCinModel->where(['user_id' => $_SESSION['USER']->user_id]);
    $data['tricycleCinNumbers'] = [];
    if (is_array($tricycleCinNumbers) || is_object($tricycleCinNumbers)) {
      foreach ($tricycleCinNumbers as $cinNumberId) {
        $data['tricycleCinNumbers'][$cinNumberId->tricycle_cin_number_id] = [
          'cin_number' => $cinNumberId->tricycle_cin_number_id,
        ];
      }
    } else {
      $data['tricycleCinNumbers'] = [];
    }

    asort($data['tricycleCinNumbers']);

    $driverModel = new Driver();
    $drivers = $driverModel->where(['user_id' => $_SESSION['USER']->user_id]);
    $data['drivers'] = [];

    if (is_array($drivers) || is_object($drivers)) {
      foreach ($drivers as $driver) {
        $data['drivers'][$driver->driver_id] = [
          'driver_id' => $driver->driver_id,
          'name' => $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name,
        ];
      }
    } else {
      $data['drivers'] = [];
    }

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$userId = $_SESSION['USER']->user_id;
      $logData = [
        'tricycle_cin_number_id' => $_POST['tricycle_cin_number_id'] ?? '',
        'driver_id' => $_POST['driver_id'] ?? '',
        'expense_date' => $_POST['date'] ?? '',
        'total_expenses' => $_POST['total_expenses'] ?? '',
        'description' => $_POST['description'] ?? '',
				'user_id' => $userId ?? '',
      ];

      $maintenanceLogModel = new MaintenanceLog();
			$errors = $maintenanceLogModel->validateData($logData);

			if (!empty($errors)) {
        $errorMessage = $errors[0];
        set_flash_message($errorMessage, "error");
        $data = array_merge($data, $logData);
      } else {
				if (!empty($_FILES['expenses_receipt_image']['name'])) {
					$imagePaths = $this->handleFileUploads($logData);

          if ($imagePaths === false) {
            set_flash_message("Failed to upload images.", "error");
            redirect('maintenance_logs');
          }

          $logData['expenses_receipt_image_path'] = $imagePaths['expenses_receipt_image'];

					if ($maintenanceLogModel->insert($logData)) {
						set_flash_message("Maintenance Log added successfully.", "success");
            redirect('maintenance_logs');
          } else {
            set_flash_message("Failed to add Maintenance Log. Please try again.", "error");
          }
				} else {
					if ($maintenanceLogModel->insert($logData)) {
						set_flash_message("Maintenance Log added successfully.", "success");
            redirect('maintenance_logs');
          } else {
            set_flash_message("Failed to add Maintenance Log. Please try again.", "error");
          }
				}
     
    	}
		}
		echo $this->renderView('new_maintenance_log', true, $data);
  }

	private function handleFileUploads($formData)
  {
    $uniqueId = uniqid();
    $uploadDirectory = 'public/uploads/maintenance_logs_receipts/' . $uniqueId;

    $expensesReceiptImageName = 'expenses_receipt_image';

    $expensesReceiptImagePath = $uploadDirectory . basename($_FILES[$expensesReceiptImageName]['name']);

    if (
      move_uploaded_file($_FILES[$expensesReceiptImageName]['tmp_name'], $expensesReceiptImagePath)
    ) {
      return [
        'expenses_receipt_image' => $expensesReceiptImagePath,
      ];
    } else {
      return false;
    }
  }
}