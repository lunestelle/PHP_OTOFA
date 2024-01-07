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
				'license_validity' => $_POST['license_validity'] ?? '',
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