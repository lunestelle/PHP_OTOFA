<?php 

class Home
{
	use Controller;

	public function index()
	{
		echo $this->renderView('home', true);
	}
}