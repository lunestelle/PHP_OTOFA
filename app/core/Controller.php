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
				'first_name' => $_SESSION['USER']->first_name,
			];
		}
	}
	
	protected function renderView($viewName, $useLayout = true, $data = [])
	{
		$this->setCurrentPage($viewName);

		if ($useLayout) {
			$layoutContent = $this->getLayoutContent();
			$viewContent = $this->getViewContent($viewName, $data);

			if ($this->current_page === 'dashboard' || $this->current_page === 'tricycle' || $this->current_page === 'driver' || $this->current_page === 'document' || $this->current_page === 'appointment' || $this->current_page === 'maintenance_log' || $this->current_page === 'operator' || $this->current_page === 'registration_approval' || $this->current_page === 'manage_tricycle' || $this->current_page === 'manage_driver') {
				$sidebarContent = $this->getSidebarContent();
				$viewContent = str_replace('{{sidebar}}', $sidebarContent, $viewContent);
			}

			$cssFile = $this->getCSSFile($this->current_page);
			$layoutContent = str_replace('{{css}}', $cssFile, $layoutContent);
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
		if ($page === 'dashboard' || $page === 'tricycle' || $page === 'driver' || $page === 'document' || $page === 'appointment' || $page === 'maintenance_log' || $page === 'operator' || $page === 'registration_approval' || $page === 'manage_tricycle' || $page === 'manage_driver') {
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