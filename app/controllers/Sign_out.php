<?php 

class Sign_out
{
	use Controller;

	public function index()
	{
		if (isset($_SESSION['USER'])) {
			unset($_SESSION['USER']);
		}

		if (isset($_SESSION['authenticated'])) {
			unset($_SESSION['authenticated']);
		}

		set_flash_message("Successfully signed out!", "success");
		redirect('');
	}
}