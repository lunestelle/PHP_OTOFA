<?php 

class Sample
{
	use Controller;

	public function index()
	{
		echo $this->renderView('sample');
	}
}