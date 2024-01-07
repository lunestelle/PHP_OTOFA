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

    $driverModel = new Driver();
    $driverData = $driverModel->first(['driver_id' => $driverId]);

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

    // Sort the array in ascending order
    asort($data['tricycleCinNumbers']);

    $selectedCinNumber = $driverData->tricycle_cin_number_id;
    $data['selectedCinNumberId'] = $selectedCinNumber ? $selectedCinNumber : null;

    if (!$driverData) {
      set_flash_message("Driver not found.", "error");
      redirect('drivers');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $updatedData = [
        'first_name' => $_POST['first_name'] ?? '',
        'last_name' => $_POST['last_name'] ?? '',
        'middle_name' => $_POST['middle_name'] ?? '',
        'address' => $_POST['address'] ?? '',
        'phone_no' => $_POST['phone_no'] ?? '',
        'birth_date' => $_POST['birth_date'] ?? '',
        'license_no' => $_POST['license_no'] ?? '',
        'license_validity' => $_POST['license_validity'] ?? '',
        'tricycle_cin_number_id' => $_POST['tricycle_cin_number_id'] ?? '',
      ];

      $errors = $driverModel->validateData($updatedData );

      if (!empty($errors)) {
				$errorMessage = $errors[0];
				set_flash_message($errorMessage, "error");
				$data = array_merge($data, $_POST);
        redirect('edit_driver?driver_id=' . $driverId);
			} else {
				$formattedPhoneNumber = $updatedData ['phone_no'];
				$updatedData ['phone_no'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);

				if ($driverModel->update(['driver_id' => $driverId], $updatedData)) {
					set_flash_message("Driver information updated successfully.", "success");
					redirect('drivers');
				} else {
					set_flash_message("Failed updating driver information. Please try again", "error");
          redirect('drivers');
				}
			}

    }

    $data = array_merge($data, [
      'driverData' => [
        'first_name' => $driverData->first_name,
        'last_name' => $driverData->last_name,
        'middle_name' => $driverData->middle_name,
        'address' => $driverData->address,
        'phone_no' => $this->formatPhoneNumber($driverData->phone_no),
        'birth_date' => $driverData->birth_date,
        'license_no' => $driverData->license_no,
        'license_validity' => $driverData->license_validity,
        'tricycle_cin_number_id' => $driverData->tricycle_cin_number_id,
      ],
      'driverId' => $driverId,
    ]);

    echo $this->renderView('edit_driver', true, $data);
  }

  private function formatPhoneNumber($phoneNumber) {
    return preg_replace('/[^0-9]/', '', str_replace('+63', '', $phoneNumber));
  }
}