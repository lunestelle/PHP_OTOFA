<?php
define('BASE_URL', 'http://localhost/PHP_Sakaycle/');

trait Controller
{
	protected $sharedData = [];
	protected $current_page;

	public function __construct()
	{
		$this->setSharedData();
	}

	protected function setSharedData()
	{
    $this->sharedData = [];

    if (isset($_SESSION['USER'])) {
			$user = $_SESSION['USER'];

			$fullName = $user->first_name . ' ' . $user->last_name;

			$this->sharedData = [
				'userRole' => $user->role,
				'firstName' => $user->first_name,
				'lastName' => $user->last_name,
				'fullName' => $fullName
		];
    }
	}
	
	protected function renderView($viewName, $useLayout = true, $data = [])
	{
    $this->setCurrentPage($viewName);

    if ($useLayout) {
			$layoutContent = $this->getLayoutContent($this->current_page);
			$viewContent = $this->getViewContent($viewName, $data);

			$cssFiles = $this->getCSSFile($this->current_page);

			$cssFileTags = '';
			foreach ($cssFiles as $cssFile) {
				$cssFileTags .= '<link rel="stylesheet" type="text/css" href="public/assets/css/' . $cssFile . '">';
			}

			$layoutContent = str_replace('{{css}}', $cssFileTags, $layoutContent);
			return str_replace('{{content}}', $viewContent, $layoutContent);
    } else {
			return $this->getViewContent($viewName, $data);
    }
	}

	protected function getLayoutContent($page)
	{
		$userLayout = ['dashboard', 'tricycles', 'drivers', 'appointments', 'maintenance_log', 'operators', 'registration_approval', 'taripa', 'export', 'view_tricycle', 'view_operator', 'view_appointment', 'view_driver', 'view_maintenance_log', 'edit_tricycle', 'edit_driver', 'edit_taripa', 'edit_appointment', 'edit_maintenance_log', 'new_taripa', 'new_driver', 'new_appointment', 'new_tricycle', 'new_tricycle', 'new_maintenance_log', 'blue_trike_info', 'green_trike_info', 'red_trike_info', 'yellow_trike_info',];

		if (in_array($page, $userLayout)) {
			extract($this->sharedData);
			$layoutFile = 'main.php';
    } else {
			$layoutFile = 'guest.php';
		}
		ob_start();
		include_once "app/views/layouts/$layoutFile";
		return ob_get_clean();
	}

	protected function getViewContent($viewName, $data)
	{
    extract($this->sharedData);
    extract($data);
    ob_start();

    $urlSegments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
    $baseSegments = explode('/', trim(BASE_URL, '/'));
    $filteredSegments = array_diff($urlSegments, $baseSegments);
    $filePath = "app/views/{$viewName}.php";

    if (count($filteredSegments) < 2) {
			if (file_exists($filePath)) {
				include_once $filePath;
			} else {
				header("Location: " . BASE_URL . "404.php");
				exit();
			}
    } else {
			header("Location: " . BASE_URL . "404.php");
			exit();
		} 

    return ob_get_clean();
	}
		
	protected function setCurrentPage($viewName)
	{
		$this->current_page = basename($viewName, '.php');
	}

	protected function getCSSFile($page)
	{
		$sidebarPages = ['dashboard', 'tricycles', 'drivers', 'appointments', 'maintenance_log', 'operators', 'registration_approval', 'taripa', 'export', 'view_tricycle', 'view_driver', 'view_operator', 'view_appointment', 'view_maintenance_log', 'edit_taripa', 'edit_tricycle', 'edit_driver', 'edit_appointment', 'edit_maintenance_log', 'new_appointment', 'new_driver', 'new_taripa', 'new_tricycle', 'new_maintenance_log', 'blue_trike_info', 'green_trike_info', 'red_trike_info', 'yellow_trike_info'];
		
		$sidebarViewPages = ['view_tricycle', 'view_driver', 'view_appointment', 'view_operator', 'view_maintenance_log'];

		$sidebarEditPages = ['edit_tricycle', 'edit_driver', 'edit_appointment', 'edit_maintenance_log'];

		$sidebarNewPages = ['new_driver', 'new_taripa', 'new_tricycle', 'new_appointment', 'new_maintenance_log'];

		$cssFile = $page . '.css';
		$cssFilePath = "public/assets/css/{$cssFile}";
		$cssFiles = [];

    if (file_exists($cssFilePath)) {
			$cssFiles[] = $cssFile;
    }

    if (in_array($page, $sidebarPages)) {
			$cssFiles[] = 'sidebar.css';
    }
		
		if (in_array($page, $sidebarViewPages)) {
			$cssFiles[] = 'view_page.css';
    } else if (in_array($page, $sidebarEditPages)) {
			$cssFiles[] ='edit_page.css';
		} else if (in_array($page, $sidebarNewPages)) {
			$cssFiles[] = 'new_page.css';
		}

    if (empty($cssFiles)) {
			$cssFiles[] = 'home.css';
    }

    return $cssFiles;
	}
}