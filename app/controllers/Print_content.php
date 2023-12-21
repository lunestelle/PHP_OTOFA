<?php 

class Print_content
{
	use Controller;

	public function index()
	{
		echo $this->renderView('print_content', true);
	}
}