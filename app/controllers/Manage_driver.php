<?php

class Manage_driver
{
	use Controller;

	public function index()
	{
		if (!is_authenticated()) {
			set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
			redirect('');
		}

		$tricycleModel = new Tricycle();
		$tricycles = $tricycleModel->findAll();

		$data['tricycles'] = [];

		foreach ($tricycles as $tricycle) {
			$data['tricycles'][$tricycle->tricycle_id] = [
				'tricycle_id' => $tricycle->tricycle_id,
				'plate_no' => $tricycle->plate_no
			];
		}

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$formData = [
				'first_name' => $_POST['first_name'] ?? '',
				'last_name' => $_POST['last_name'] ?? '',
				'middle_name' => $_POST['middle_name'] ?? '',
				'address' => $_POST['address'] ?? '',
				'phone_no' => $_POST['phone_no'] ?? '',
				'birth_date' => $_POST['birth_date'] ?? '',
				'license_no' => $_POST['license_no'] ?? '',
				'license_validity' => $_POST['license_validity'] ?? '',
				'tricycle_id' => $_POST['tricycle_id'] ?? ''
			];

			$driverModel = new Driver();
			$errors = $driverModel->validateData($formData);

			if (!empty($errors)) {
				set_flash_message("Please fix the following errors: <br>" . implode("<br>", $errors), "error");
				$data = array_merge($formData, $data);
				echo $this->renderView('manage_driver', true, $data);
				return;
			}

			if ($driverModel->insert($formData)) {
				set_flash_message("Driver added successfully.", "success");
				redirect('driver');
			} else {
				set_flash_message("Failed to add driver.", "error");
			}
		}

		echo $this->renderView('manage_driver', true, $data);
	}
}