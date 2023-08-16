<?php 

class Home
{
	use Controller;

	public function index()
	{
		if (is_authenticated()) {
      set_flash_message("You are already signed in.", "error");
      redirect('dashboard');
    }

		echo $this->renderView('home', true);
	}
}