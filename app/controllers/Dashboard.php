<?php 

class Dashboard
{
	use Controller;

	public function index()
	{
		echo $this->renderView('dashboard');
	}
}