<?php 

class Print_taripa_content
{
	use Controller;

	public function index()
	{
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
      set_flash_message("Invalid request method.", "error");
      redirect('');
    }
		
		echo $this->renderView('print_taripa_content', true);
	}
}