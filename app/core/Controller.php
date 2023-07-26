<?php

trait Controller
{
	protected $sharedData = [];

	public function __construct()
	{
		$this->setSharedData();
	}

	protected function setSharedData()
	{
		$this->sharedData = [];

		if (isset($_SESSION['USER'])) {
			$this->sharedData = [
				'user_role' => $_SESSION['USER']->role,
				'firstName' => $_SESSION['USER']->first_name,
			];
		}
	}
	
	protected function renderView($viewName, $useLayout = true, $data = [])
	{
    $this->setCurrentPage($viewName);

    if ($useLayout) {
			$layoutContent = $this->getLayoutContent();
			$viewContent = $this->getViewContent($viewName, $data);

			if (in_array($this->current_page, ['dashboard', 'tricycles', 'drivers', 'documents', 'appointment', 'maintenance_log', 'operator', 'registration_approval', 'taripa', 'new_tricycle', 'new_driver', 'new_taripa', 'edit_taripa'])) {
				$sidebarContent = $this->getSidebarContent();
				$viewContent = str_replace('{{sidebar}}', $sidebarContent, $viewContent);
			}

			$cssFiles = $this->getCSSFile($this->current_page);

			$cssFileTags = '';
			foreach ($cssFiles as $cssFile) {
				$cssFileTags .= '<link rel="stylesheet" type="text/css" href="../public/assets/css/' . $cssFile . '">';
			}

			$layoutContent = str_replace('{{css}}', $cssFileTags, $layoutContent);
			return str_replace('{{content}}', $viewContent, $layoutContent);
    } else {
			return $this->getViewContent($viewName, $data);
    }
	}

	protected function getLayoutContent()
	{
		ob_start();
		include_once "../app/views/layouts/main.php";
		return ob_get_clean();
	}

	protected function getSidebarContent()
	{
		extract($this->sharedData);
		ob_start();
		include_once "../app/views/layouts/sidebar.php";
		return ob_get_clean();
	}

	protected function getViewContent($viewName, $data)
	{
		extract($this->sharedData);
		extract($data);
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
		$sidebarPages = ['dashboard', 'tricycles', 'drivers', 'documents', 'appointment', 'maintenance_log', 'operator', 'registration_approval', 'taripa', 'new_tricycle', 'new_driver', 'new_taripa', 'edit_taripa'];

		$cssFile = $page . '.css';
    $cssFilePath = "../public/assets/css/{$cssFile}";
    $cssFiles = [];

    if (file_exists($cssFilePath)) {
			$cssFiles[] = $cssFile;
    }

    if (in_array($page, $sidebarPages)) {
			$cssFiles[] = 'sidebar.css';
    }

    if (empty($cssFiles)) {
			$cssFiles[] = 'home.css';
    }

    return $cssFiles;
	}

}