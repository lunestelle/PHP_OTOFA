<?php

class Sign_up
{
	use Controller;

	public function index()
	{
		$data = [];

		if (is_authenticated()) {
			set_flash_message("You are already signed in.", "error");
			redirect('');
		}

		// checks if the request is an AJAX call by checking the 'HTTP_X_REQUESTED_WITH'
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
      set_flash_message("Invalid request method.", "error");
      redirect('');
    }
		
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$user = new User();

			if ($user->validate($_POST)) {
				$hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

				$profilePhotoPath = generateProfilePicture(strtoupper($_POST['first_name'][0] . $_POST['last_name'][0]));

				$userData = [
					'email' => $_POST['email'],
					'first_name' => ucwords($_POST['first_name']),
					'last_name' => ucwords($_POST['last_name']),
					'password' => $hashedPassword,
					'generated_profile_photo_path' => $profilePhotoPath
				];

				$user->insert($userData);
				$_SESSION['USER'] = $user->first(['email' => $_POST['email']]);
				$_SESSION['authenticated'] = true;

				$response = ['status' => 'success', 'msg' => 'Account created successfully!', 'redirect_url' => 'dashboard'];
        echo json_encode($response);
        exit;
			} else {
				$data['errors'] = $user->getErrors();
				$errorCount = count($data['errors']);
				$errorMessages = implode(($errorCount > 1 ? ', ' : ''), $data['errors']);
				if ($errorCount > 1) {
					$errorMessages = str_replace('.', '', $errorMessages);
				}
				$errorMessages = str_replace('<br>', '', $errorMessages);
				echo json_encode(['status' => 'error', 'msg' => $errorMessages]);
				exit;
			}			
		}

		echo $this->renderView('sign_up', false, $data);
	}
}