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

    // Fetch all statuses associated with the driver
    $driverStatusesModel = new DriverStatuses();
    $statuses = $driverStatusesModel->where(['driver_id' => $driverId]);

    $statusValues = [];
    $isActive = false;
    $driverLicenseExpired = false;
    foreach ($statuses as $status) {
      $statusValues[] = $status->status;
      if ($status->status === 'Active') {
        $isActive = true;
      }

      if ($status->status === 'Driver License Expired') {
        $driverLicenseExpired = true;
      }
    }

    $driverModel = new Driver();
    $driverStatusesModel = new DriverStatuses();
    $tricycleCinModel = new TricycleCinNumber();

    // Get tricycle plate CIN numbers owned by the current user
    $userTricycleCinNumbers = $tricycleCinModel->where(['user_id' => $_SESSION['USER']->user_id]);

    $userTricycleCinIds = array_map(function($tricycleCin) {
      return $tricycleCin->tricycle_cin_number_id;
    }, $userTricycleCinNumbers);

    // Convert array of tricycle CIN numbers to comma-separated string
    $userTricycleCinIdsString = implode(',', $userTricycleCinIds);

    $query = "SELECT DISTINCT drivers.tricycle_cin_number_id FROM drivers JOIN driver_statuses ON drivers.driver_id = driver_statuses.driver_id WHERE drivers.tricycle_cin_number_id IN ($userTricycleCinIdsString) AND driver_statuses.status = 'Active' AND drivers.driver_id != $driverId"; 

    $assignedTricycleCinIds = $driverModel->query($query);

    // Extract tricycle CIN number IDs from the objects returned by the query
    $assignedTricycleCinIds = array_map(function($result) {
      return $result->tricycle_cin_number_id;
    }, $assignedTricycleCinIds);

    // Filter out the unassigned tricycle plate CIN numbers
    $unassignedTricycleCinNumbers = array_diff($userTricycleCinIds, $assignedTricycleCinIds);

    $data['selectedCinNumberId'] = $driverData->tricycle_cin_number_id;

    foreach ($unassignedTricycleCinNumbers as $cinNumber) {
      $data['tricycleCinNumbers'][$cinNumber] = [
        'cin_number' => $cinNumber,
      ];
    }

    asort($data['tricycleCinNumbers']);

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
        'license_expiry_date' => $_POST['license_expiry_date'] ?? '',
        'tricycle_cin_number_id' => $_POST['tricycle_cin_number_id'] ?? '',
        'status' => $_POST['status'] ?? '',
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
          if ($updatedData['status'] == 'Inactive') {
            // Delete all existing statuses and set the new one to Inactive
            $driverStatusesModel->delete(['driver_id' => $driverId], ['status !=' => 'Inactive']);
            $driverStatusesModel->insert(['driver_id' => $driverId, 'status' => 'Inactive']);
            $driverModel->update(['driver_id' => $driverId], ['last_notification_date' => null]);
          } elseif ($updatedData['status'] == 'Active')  {
            $driverStatusesModel->delete(['driver_id' => $driverId], ['status' => 'Inactive']);
            $driverStatusesModel->insert(['driver_id' => $driverId, 'status' => 'Active']);
          }

          // Update license status if the license expiry date is in the future
          if ($driverLicenseExpired) {
            $driverData = $driverModel->first(['driver_id' => $driverId]);
            $expiryDate = new DateTime($driverData->license_expiry_date);
            $currentDate = new DateTime();

            if ($expiryDate > $currentDate) {
              $driverStatusesModel->delete(['driver_id' => $driverId, 'status' => 'Driver License Expired']);
              $driverModel->update(['driver_id' => $driverId], ['last_notification_date' => null]);
            }
          }

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
        'license_expiry_date' => $driverData->license_expiry_date,
        'tricycle_cin_number_id' => $driverData->tricycle_cin_number_id,
      ],
      'driverId' => $driverId,
      'statuses' => $statusValues,
      'isActive' => $isActive,
    ]);

    echo $this->renderView('edit_driver', true, $data);
  }

  private function formatPhoneNumber($phoneNumber) {
    return preg_replace('/[^0-9]/', '', str_replace('+63', '', $phoneNumber));
  }
}