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

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$formData = [
				'first_name' => $_POST['first_name'] ?? '',
				'last_name' => $_POST['last_name'] ?? '',
				'middle_name' => $_POST['middle_name'] ?? '',
				'address' => $_POST['address'] ?? '',
				'phone_no' => $_POST['phone_no'] ?? '',
				'birth_date' => $_POST['birth_date'] ?? '',
				'license_no' => $_POST['license_no'] ?? '',
				'license_validity' => $_POST['license_validity'] ?? ''
			];

			$driverModel = new Driver();
			$errors = $driverModel->validateData($formData);

			if (!empty($errors)) {
				$errorMessage = $errors[0];
				set_flash_message($errorMessage, "error");
				$data = array_merge($formData);
				echo $this->renderView('new_driver', true, $data);
				return;
			} else {
				$formattedPhoneNumber = $formData['phone_no'];
				$formData['phone_no'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);

				if ($driverModel->insert($formData)) {
					set_flash_message("Driver added successfully.", "success");
					redirect('drivers');
				} else {
					set_flash_message("Failed to add driver.", "error");
				}
			}
		}

		echo $this->renderView('new_driver', true);
	}
}