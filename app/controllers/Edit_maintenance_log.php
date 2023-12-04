<?php

class Edit_maintenance_log {
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }

    $maintenanceLogId = isset($_GET['maintenance_log_id']) ? $_GET['maintenance_log_id'] : null;

    $maintenanceLogModel = new MaintenanceLog();
    $maintenanceLogData = $maintenanceLogModel->first(['maintenance_log_id' => $maintenanceLogId]);

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
      $updatedData = [
        'tricycle_id' => $_POST['tricycle_id'] ?? '',
        'driver_id' => $_POST['driver_id'] ?? '',
        'expense_date' => $_POST['expense_date'] ?? '',
        'total_expenses' => $_POST['total_expenses'] ?? '',
        'description' => $_POST['description'] ?? '',
        'expenses_receipt_image' => $_FILES['expenses_receipt_image'] ?? '',
      ];

      if (isset($_POST['confirm_delete_image'])) {
        $imageType = $_POST['image_type'];
        $imagePathColumn = "{$imageType}_view_image_path";
        
        // Check if the file exists before attempting to delete
        if (file_exists($_POST['original_image_path'])) {
          $deleted = unlink($_POST['original_image_path']);
          
          // Update the database column with an empty value if deletion was successful
          if ($deleted) {
            $maintenanceLogModel->update(['maintenance_log_id' => $maintenanceLogId], [$imagePathColumn => null]);
            set_flash_message("Receipt Image deleted successfully.", "success");
            redirect('edit_maintenance_log?maintenance_log_id=' . $maintenanceLogId);
          } else {
            set_flash_message("Failed to delete the image.", "error");
            redirect('edit_maintenance_log?maintenance_log_id=' . $maintenanceLogId);
          }
        } else {
          set_flash_message("File not found. Image may have been deleted already.", "error");
          redirect('edit_maintenance_log?maintenance_log_id=' . $maintenanceLogId);
        }
      }

      if (isset($_POST['update_maintenance_log'])) {
        $errors = $maintenanceLogModel->validateData($updatedData);

        if (!empty($errors)) {
          $errorMessage = $errors[0];
          set_flash_message($errorMessage, "error");
          $data = array_merge($data, $_POST);
          redirect('edit_maintenance_log?maintenance_log_id=' . $maintenanceLogId);
        } else {
          $isExpensesReceiptImageRemoved = empty($_FILES['expenses_receipt_image']['name']);

          $expensesReceiptImagePath = $isExpensesReceiptImageRemoved
            ? $_POST['original_expenses_receipt_image']
            : $this->handleFileUpload($updatedData['expenses_receipt_image'], 'expenses_receipt_image');

          $updatedData['expenses_receipt_image_path'] = $expensesReceiptImagePath;

          if ($maintenanceLogModel->update(['maintenance_log_id' => $maintenanceLogId], $updatedData)) {
            set_flash_message("Maintenance Log Information updated successfully.", "success");
            redirect('maintenance_log');
          } else {
            set_flash_message("Failed updating maintenance log information. Please try again", "error");
            redirect('maintenance_log');
          }
        }
      }      
    }

    $data = array_merge($data, [
      'maintenanceLogData' => [
        'tricycle_id' => $maintenanceLogData->tricycle_id,
        'driver_id' => $maintenanceLogData->driver_id,
        'expense_date' => $maintenanceLogData->expense_date,
        'total_expenses' => $maintenanceLogData->total_expenses,
        'description' => $maintenanceLogData->description,
        'expenses_receipt_image_path' => $maintenanceLogData->expenses_receipt_image_path,
      ],
      'maintenance_log_id' => $maintenanceLogId,
    ]);

    echo $this->renderView('edit_maintenance_log', true, $data);
  }

  private function handleFileUpload($file, $imageName)
  {
    $uploadDirectory = 'public/uploads/maintenance_logs_receipts/';
    
    // Check if the file was uploaded without errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
      // Handle the error appropriately (e.g., log it or return an error message)
      return '';
    }

    $imagePath = $uploadDirectory . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $imagePath)) {
      return $imagePath;
    } else {
      return '';
    }
  }
}