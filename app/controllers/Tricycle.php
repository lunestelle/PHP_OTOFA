<?php 

class Tricycle
{
	use Controller;

	public function index()
	{
		echo $this->renderView('tricycle');
	}
}