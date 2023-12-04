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

    $tricycleModel = new Tricycle();
		$tricycles = $tricycleModel->where(['user_id' => $_SESSION['USER']->user_id]);
		$data['tricycles'] = [];

		if (is_array($tricycles) || is_object($tricycles)) {
			foreach ($tricycles as $tricycle) {
				$data['tricycles'][$tricycle->tricycle_id] = [
					'tricycle_id' => $tricycle->tricycle_id,
					'plate_no' => $tricycle->plate_no
				];
			}
		} else {
			$data['tricycles'] = [];
		}

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
        'tricycle_id' => $_POST['tricycle_id'] ?? '',
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
        $data['logData'] = $logData;
      } else {
				if (!empty($_FILES['expenses_receipt_image']['name'])) {
					$imagePaths = $this->handleFileUploads($logData);

          if ($imagePaths === false) {
            set_flash_message("Failed to upload images.", "error");
            redirect('maintenance_log');
          }

          $logData['expenses_receipt_image_path'] = $imagePaths['expenses_receipt_image'];

					if ($maintenanceLogModel->insert($logData)) {
						set_flash_message("Maintenance Log added successfully.", "success");
            redirect('maintenance_log');
          } else {
            set_flash_message("Failed to add Maintenance Log. Please try again.", "error");
          }
				} else {
					if ($maintenanceLogModel->insert($logData)) {
						set_flash_message("Maintenance Log added successfully.", "success");
            redirect('maintenance_log');
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