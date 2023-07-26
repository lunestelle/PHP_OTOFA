<?php

class New_tricycle
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }

    $driverModel = new Driver();
    $drivers = $driverModel->findAll();
    $data['drivers'] = [];

    foreach ($drivers as $driver) {
      $data['drivers'][$driver->driver_id] = [
        'driver_id' => $driver->driver_id,
        'name' => $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name
      ];
    }

    if (isset($_POST['route_area'])) {
      $taripasModel = new Taripas();
      $routeArea = $_POST['route_area'];
      $taripaData = $taripasModel->where(['route_area' => $routeArea]);
    
      echo json_encode($taripaData);
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $tricycleModel = new Tricycle();
      $documentModel = new Document();
      $validationErrors = $tricycleModel->validate($_POST);

      if (empty($validationErrors)) {
        $tricycleData = [
          'make_model' => $_POST['make_model'],
          'year_acquired' => $_POST['year_acquired'],
          'color_code' => $_POST['color_code'],
          'route_area' => $_POST['route_area'],
          'plate_no' => $_POST['plate_no'],
          'driver_id' => $_POST['driver_id'],
          'or_no' => $_POST['or_no'],
          'or_date' => $_POST['or_date'],
          'tricycle_status' => 'Registration Pending'
        ];

        $tricycleId = $tricycleModel->insert($tricycleData);
        $fileUploadSuccess = true;

        if ($tricycleId) {
          foreach ($_FILES as $key => $file) {
            if ($file['error'] === UPLOAD_ERR_OK) {
              $cleanKey = str_replace(['-', '_'], ' ', $key);
              $file_path = uniqid() . '_' . $file['name'];
              $filename = $cleanKey;

              move_uploaded_file($file['tmp_name'], '../uploads/' . $file_path);

              $documentData = [
                'tricycle_id' => $tricycleId,
                'document_type' => $documentModel->setDocumentType($file),
                'filename' => $filename,
                'file_path' => '../uploads/' . $file_path
              ];

              $documentInserted = $documentModel->insert($documentData);

              if (!$documentInserted) {
                $fileUploadSuccess = false;
              }
            }
          }

          if ($fileUploadSuccess) {
            set_flash_message("New tricycle has been successfully saved.", "success");
            redirect('tricycles');
          } else {
            set_flash_message("Failed to save the new tricycle's documents. Please try again.", "error");
           
          }
        } else {
          set_flash_message("Failed to save the new tricycle. Please try again.", "error");
          
        }
      } else {
        set_flash_message(implode('<br>', $validationErrors), "error");

        $data['make_model'] = $_POST['make_model'];
        $data['year_acquired'] = $_POST['year_acquired'];
        $data['color_code'] = $_POST['color_code'];
        $data['route_area'] = $_POST['route_area'];
        $data['plate_no'] = $_POST['plate_no'];
        $data['driver_id'] = $_POST['driver_id'];
        $data['or_no'] = $_POST['or_no'];
        $data['or_date'] = $_POST['or_date'];

        echo $this->renderView('new_tricycle', true, $data);
      }
    } else {
      echo $this->renderView('new_tricycle', true, $data);
    }
  }
}