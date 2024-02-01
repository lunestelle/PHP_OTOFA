<?php

class New_driver
{
	use Controller;

	public function index()
	{
		if (!is_authenticated()) {
			set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
			redirect('');
		}

    $tricycleCinModel = new TricycleCinNumber();
		$driverModel = new Driver();
    $tricycleCinNumbers = $tricycleCinModel->where(['user_id' => $_SESSION['USER']->user_id]);

		// Get tricycle plate CIN numbers owned by the current user
		$userTricycleCinNumbers = $tricycleCinModel->where(['user_id' => $_SESSION['USER']->user_id]);

		// Extract tricycle CIN number IDs from the objects
		$userTricycleCinIds = array_map(function($tricycleCin) {
			return $tricycleCin->tricycle_cin_number_id;
		}, $userTricycleCinNumbers);

		// Convert array of tricycle CIN numbers to comma-separated string
		$userTricycleCinIdsString = implode(',', $userTricycleCinIds);

    $query = "SELECT DISTINCT drivers.tricycle_cin_number_id FROM drivers JOIN driver_statuses ON drivers.driver_id = driver_statuses.driver_id WHERE drivers.tricycle_cin_number_id IN ($userTricycleCinIdsString) AND driver_statuses.status = 'Active' AND drivers.user_id = :user_id";

    $assignedTricycleCinIds = $driverModel->query($query, [':user_id' => $_SESSION['USER']->user_id]);

		if (is_array($assignedTricycleCinIds)) {
			$assignedTricycleCinIds = array_map(function($result) {
				return $result->tricycle_cin_number_id;
			}, $assignedTricycleCinIds);
		} else {
			// Handle the case when $assignedTricycleCinIds is not an array
			$assignedTricycleCinIds = [];
		}

		// Filter out the unassigned tricycle plate CIN numbers
		$unassignedTricycleCinNumbers = array_diff($userTricycleCinIds, $assignedTricycleCinIds);

		$data['tricycleCinNumbers'] = [];

		foreach ($unassignedTricycleCinNumbers as $cinNumberId) {
			$data['tricycleCinNumbers'][$cinNumberId] = [
				'cin_number' => $cinNumberId,
			];
		}

		asort($data['tricycleCinNumbers']);

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$userId = $_SESSION['USER']->user_id;
			$formData = [
				'first_name' => ucwords($_POST['first_name']) ?? '',
				'last_name' => ucwords($_POST['last_name']) ?? '',
				'middle_name' => ucwords($_POST['middle_name']) ?? '',
				'address' => ucwords($_POST['address']) ?? '',
				'phone_no' => $_POST['phone_no'] ?? '',
				'birth_date' => $_POST['birth_date'] ?? '',
				'license_no' => $_POST['license_no'] ?? '',
				'license_expiry_date' => $_POST['license_expiry_date'] ?? '',
				'user_id' => $userId ?? '',
				'tricycle_cin_number_id' => $_POST['tricycle_cin_number_id'] ?? '',
			];

			$driverModel = new Driver();
			$errors = $driverModel->validateData($formData);

			if (!empty($errors)) {
				$errorMessage = $errors[0];
				set_flash_message($errorMessage, "error");
				$data = array_merge($data, $formData);
			} else {
				$formattedPhoneNumber = $formData['phone_no'];
				$formData['phone_no'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);

				if ($driverModel->insert($formData)) {
					$driverStatusesModel = new DriverStatuses;
					$driverId = $driverModel->getLastInsertedRecord()[0]->driver_id;
					$driverStatusesModel->insert(['driver_id' => $driverId, 'status' => 'Active']);
					set_flash_message("Driver added successfully.", "success");
					redirect('drivers');
				} else {
					set_flash_message("Failed to add driver.", "error");
				}
			}
		}
    echo $this->renderView('new_driver', true, $data);
	}
}