<?php

trait Controller
{
	protected function renderView($viewName, $useLayout = true)
	{
    $this->setCurrentPage($viewName);

    if ($useLayout) {
			ob_start();
			include_once "../app/views/layouts/main.php";
			$layoutContent = ob_get_clean();
			$viewContent = $this->getViewContent($viewName);
			$cssFile = $this->getCSSFile($this->current_page);
			$layoutContent = str_replace('{{css}}', $cssFile, $layoutContent);
			return str_replace('{{content}}', $viewContent, $layoutContent);
    } else {
			return $this->getViewContent($viewName);
    }
	}

	protected function getViewContent($viewName)
	{
		ob_start();
		$filePath = "../app/views/{$viewName}.php";
		if (file_exists($filePath)) {
			include_once $filePath;
		} else {
			include_once "../app/views/404.php";
		}
		return ob_get_clean();
	}

	protected function setCurrentPage($viewName)
	{
		$this->current_page = basename($viewName, '.php');
	}

	protected function getCSSFile($page)
	{
		$cssFile = $page . '.css';
		$cssFilePath = "../public/assets/css/{$cssFile}";

		if (file_exists($cssFilePath)) {
			return $cssFile;
		} else {
			return 'home.css';
		}
	}
}