<?php

class View_driver
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }

    $driverId = isset($_GET['driver_id']) ? $_GET['driver_id'] : null;

    $driverModel = new Driver();
    $driverData = $driverModel->first(['driver_id' => $driverId]);

    $tricycleModel = new Tricycle();
    $tricycleData = $tricycleModel->first(['tricycle_id' => $driverData->tricycle_id]);
    $tricyclePlateNumber = $tricycleData !== false ? $tricycleData->plate_no : '';

    if (!$driverData) {
      set_flash_message("Driver not found.", "error");
      redirect('drivers');
    }

    $data = [
      'first_name' => $driverData->first_name,
      'last_name' => $driverData->last_name,
      'middle_name' => $driverData->middle_name,
      'address' => $driverData->address,
      'phone_no' => $driverData->phone_no,
      'birth_date' => $driverData->birth_date,
      'license_no' => $driverData->license_no,
      'license_validity' => $driverData->license_validity,
      'tricycle_plate_number' => $tricyclePlateNumber,
      'full_name' => $driverData->first_name . ' ' . $driverData->middle_name . ' ' . $driverData->last_name, 
    ];

    echo $this->renderView('view_driver', true, $data);
  }
}
