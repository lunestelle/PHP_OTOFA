<?php

class Edit_tricycle
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }

    $tricycleId = isset($_GET['tricycle_id']) ? $_GET['tricycle_id'] : null;

    $tricycleModel = new Tricycle();
    $tricycleData = $tricycleModel->first(['tricycle_id' => $tricycleId]);

    if (!$tricycleData) {
      set_flash_message("Tricycle not found.", "error");
      redirect('tricycles');
    }

    $driverModel = new Driver();
    $drivers = $driverModel->findAll();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
      $dataToUpdate = [
        'make_model' => $_POST['make_model'],
        'year_acquired' => $_POST['year_acquired'],
        'color_code' => $_POST['color_code'],
        'route_area' => $_POST['route_area'],
        'plate_no' => $_POST['plate_no'],
        'driver_id' => $_POST['driver_id'],
        'or_no' => $_POST['or_no'],
        'or_date' => $_POST['or_date'],
        'tricycle_status' => $_POST['tricycle_status'],
      ];

      $validationErrors = $tricycleModel->validateData($dataToUpdate);

      if (!empty($validationErrors)) {
        set_flash_message($validationErrors[0], "error");
        $data = array_merge($dataToUpdate, $data);
        echo $this->renderView('edit_tricycle', true, $data);
        return;
      } else {
        $tricycleModel->update(['tricycle_id' => $tricycleId], $dataToUpdate);
        set_flash_message("Tricycle updated successfully.", "success");
        redirect('tricycles');
      }
    }

    // Load available plate numbers
    $selectedPlateNumber = $tricycleData->plate_no;
    $availablePlateNumbers = $this->getAvailablePlateNumbers($tricycleModel, $selectedPlateNumber);

 
    $data = [
      'tricycleData' => [
        'make_model' => $tricycleData->make_model,
        'year_acquired' => $tricycleData->year_acquired,
        'color_code' => $tricycleData->color_code,
        'route_area' => $tricycleData->route_area,
        'plate_no' => $tricycleData->plate_no,
        'driver_id' => $tricycleData->driver_id,
        'or_no' => $tricycleData->or_no,
        'or_date' => $tricycleData->or_date,
        'tricycle_status' => $tricycleData->tricycle_status,
        'front_view_image_path' => $tricycleData->front_view_image_path,
        'back_view_image_path' => $tricycleData->back_view_image_path,
        'side_view_image_path' => $tricycleData->side_view_image_path,
      ],
      'drivers' => [],
      'availablePlateNumbers' => $availablePlateNumbers,
    ];

    foreach ($drivers as $driver) {
      $data['drivers'][$driver->driver_id] = [
        'driver_id' => $driver->driver_id,
        'name' => $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name,
      ];
    }

    echo $this->renderView('edit_tricycle', true, $data);
  }

  private function getAvailablePlateNumbers($tricycleModel, $selectedPlateNumber)
  {
    // Get all plate numbers from the database
    $allPlateNumbers = $tricycleModel->pluck('plate_no');

    // Include the selected plate number in the dropdown options
    $availablePlateNumbers = [$selectedPlateNumber];

    // Generate a range of plate numbers from 0 to 2000
    $allPlateNumbersRange = range(0, 2000);

    // Exclude plate numbers that are in the database
    $availablePlateNumbers = array_merge($availablePlateNumbers, array_diff($allPlateNumbersRange, $allPlateNumbers));

    // Sort the plate numbers
    sort($availablePlateNumbers);

    return $availablePlateNumbers;
  }
}