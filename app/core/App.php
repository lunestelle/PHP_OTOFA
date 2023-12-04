<?php

class App
{
	private $controller = 'Home';
	private $method = 'index';
	private $params;

	private function splitURL()
	{
		$url = $_GET['url'] ?? 'home';
		$url = explode("/", trim($url, "/"));
		return $url;
	}

	public function loadController()
	{
		$url = $this->splitURL();
		$controllerName = ucfirst($url[0]);
		$controllerFile = "app/controllers/{$controllerName}.php";

		if (file_exists($controllerFile)) {
				require $controllerFile;
				$this->controller = $controllerName;
				unset($url[0]);
		} else {
				require "app/controllers/_404.php";
				$this->controller = "_404";
		}

		$controller = new $this->controller;

		if (!empty($url[1]) && method_exists($controller, $url[1])) {
				$this->method = $url[1];
				unset($url[1]);
		}

		$this->params = (count ($url) > 0) ? $url : ["home"];

		call_user_func_array([$controller, $this->method], $this->params);
	}
}