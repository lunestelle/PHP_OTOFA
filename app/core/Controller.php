<?php

Trait Controller
{
	public function view($viewName)
	{
		$filePath = "../app/views/" . $viewName . ".php";
		if (file_exists($filePath)) {
			require $filePath;
		} else {
			$notFoundFilePath = "../app/views/404.php";
			require $notFoundFilePath;
		}
	}
}