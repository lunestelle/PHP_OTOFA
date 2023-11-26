<?php

class Edit_driver {
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }

    $driverId = isset($_GET['driver_id']) ? $_GET['driver_id'] : null;

    $driverModel = new Driver(); // Use the correct model (Driver) here
    $driverData = $driverModel->first(['driver_id' => $driverId]);

    if (!$driverData) {
      set_flash_message("Driver not found.", "error");
      redirect('drivers');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $updatedData = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'middle_name' => $_POST['middle_name'],
        'address' => $_POST['address'],
        'phone_no' => $_POST['phone_no'],
        'birth_date' => $_POST['birth_date'],
        'license_no' => $_POST['license_no'],
        'license_validity' => $_POST['license_validity'],
      ];

      $result = $driverModel->update(['driver_id' => $driverId], $updatedData);

      if ($result) {
        set_flash_message("Driver information updated successfully.", "success");
        redirect('drivers');
      } else {
        set_flash_message("Error updating driver information. Please try again", "error");
        redirect('drivers');
      }
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
      'driverId' => $driverId,
    ];

    echo $this->renderView('edit_driver', true, $data);
  }
}