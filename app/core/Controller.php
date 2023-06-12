<?php

trait Controller
{
	protected function renderView($viewName)
	{
		$this->setCurrentPage($viewName);

		ob_start();
		include_once "../app/views/layouts/main.php";
		$layoutContent = ob_get_clean();

		ob_start();
		$filePath = "../app/views/{$viewName}.php";
		if (file_exists($filePath)) {
			include_once $filePath;
		} else {
			include_once "../app/views/404.php";
		}
		$viewContent = ob_get_clean();

		$cssFile = $this->getCSSFile($this->current_page);
		$layoutContent = str_replace('{{css}}', $cssFile, $layoutContent);

		return str_replace('{{content}}', $viewContent, $layoutContent);
	}

	protected function setCurrentPage($viewName)
	{
		$this->current_page = basename($viewName, '.php');
	}

	protected function getCSSFile($page)
	{
		if ($page === 'sign_in' || $page === 'sign_up' || $page === 'forgot_password' || $page === 'reset_password') {
			return 'authentication.css';
		} else {
			$cssFile = $page . '.css';
			$cssFilePath = "../public/assets/css/{$cssFile}";

			if (file_exists($cssFilePath)) {
				return $cssFile;
			} else {
				return 'home.css';
			}
		}
	}
}