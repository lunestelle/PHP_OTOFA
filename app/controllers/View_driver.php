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

    $tricycleCinModel = new TricycleCinNumber();
    $tricycleCinData = $tricycleCinModel->first(['tricycle_cin_number_id' => $driverData->tricycle_cin_number_id]);
    $tricyclePlateNumber = $tricycleCinData !== false ? $tricycleCinData->cin_number : '';

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
      'license_expiry_date' => $driverData->license_expiry_date,
      'tricycle_plate_number' => $tricyclePlateNumber,
      'full_name' => $driverData->first_name . ' ' . $driverData->middle_name . ' ' . $driverData->last_name, 
    ];

    echo $this->renderView('view_driver', true, $data);
  }
}
