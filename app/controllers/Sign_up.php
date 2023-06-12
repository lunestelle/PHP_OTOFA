<?php

class Sign_up
{
	use Controller;

	public function index()
	{
		$data = [];

		if (is_authenticated()) {
			redirect('');
		}
		
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$user = new User();

			if ($user->validate($_POST)) {
				$hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

				$userData = [
					'email' => $_POST['email'],
					'first_name' => $_POST['first_name'],
					'last_name' => $_POST['last_name'],
					'password' => $hashedPassword
				];

				// Insert the user into the database
				$user->insert($userData);
				$_SESSION['USER'] = $user->first(['email' => $email]);
				$_SESSION['authenticated'] = true;
				$_SESSION['user_email'] = $_POST['email'];
				$_SESSION['user_first_name'] = $_POST['first_name'];

				set_flash_message("Account created successfully!", "success");
				redirect('');
			} else {
				$data['errors'] = $user->getErrors();
				$errorMessages = implode('<br>', $data['errors']);
				set_flash_message("{$errorMessages}", "error");
				redirect('sign_up');
			}
		}

		echo $this->renderView('sign_up', $data);
	}
}