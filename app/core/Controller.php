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

        if ($this->current_page === 'dashboard' || $this->current_page === 'tricycle' || $this->current_page === 'driver' || $this->current_page === 'document' || $this->current_page === 'appointment' || $this->current_page === 'maintenance_log') {
            ob_start();
            include_once "../app/views/layouts/sidebar.php";
            $sidebarContent = ob_get_clean();
            $viewContent = str_replace('{{sidebar}}', $sidebarContent, $viewContent);
        }

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
		if ($page === 'dashboard' || $page === 'tricycle' || $page === 'driver' || $page === 'document' || $page === 'appointment' || $page === 'maintenance_log') {
			return 'sidebar.css';
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