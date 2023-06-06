<?php 

class Sign_out
{
	use Controller;

	public function index()
	{
		if (isset($_GET['token']) && $_GET['token'] === $_SESSION['logout_token']) {
			if (isset($_SESSION['USER'])) {
				unset($_SESSION['USER']);
			}

			if (isset($_SESSION['authenticated'])) {
        unset($_SESSION['authenticated']);
			}

				set_flash_message("Successfully signed out!", "success");
		} else {
      set_flash_message("Invalid sign-out request!", "error");
		}

		redirect('');
	}
}
