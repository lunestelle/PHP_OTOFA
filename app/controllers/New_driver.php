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

		$tricycleModel = new Tricycle();
		$tricycles = $tricycleModel->where(['user_id' => $_SESSION['USER']->user_id]);
		$data['tricycles'] = [];

		if (is_array($tricycles) || is_object($tricycles)) {
			foreach ($tricycles as $tricycle) {
				$data['tricycles'][$tricycle->tricycle_id] = [
					'tricycle_id' => $tricycle->tricycle_id,
					'plate_no' => $tricycle->plate_no
				];
			}
		} else {
			$data['tricycles'] = [];
		}

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
				'license_validity' => $_POST['license_validity'] ?? '',
				'user_id' => $userId ?? '',
				'tricycle_id' => $_POST['tricycle_id'] ?? '',
			];

			$driverModel = new Driver();
			$errors = $driverModel->validateData($formData);

			if (!empty($errors)) {
				$errorMessage = $errors[0];
				set_flash_message($errorMessage, "error");
				$data['tricycle_id'] = $_POST['tricycle_id'] ?? '';
				$data = array_merge($data, $formData);
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
    echo $this->renderView('new_driver', true, $data);
	}
}