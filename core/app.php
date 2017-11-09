<?php

class App
{
	public $db;

	public function __construct() {
		$db = new Database ;
		$db->init() ;
		$this->db = $db->pdo ;
	}

	public function init()
	{
		$this->parseUrl();
	}

	public function loadIndex(){
		require_once CONTROLLER_PATH.'page.php';
		$home = new page;
		$home->indexAction();
	}

	public function loadNotFound(){
		header("HTTP/1.0 404 Not Found");
		echo '<h1>404 Not Found</h1>';
		echo '<p>Halaman tidak ditemukan</p>';
	}

	public function parseUrl()
	{
		if (!isset($_GET['url']))
		{
			$this->loadIndex();
		} else {	
			$url = filter_var($_GET['url'], FILTER_SANITIZE_URL);
			$url = trim($url, '/');
			$url = explode('/', $url);
			if (!isset($url[0]))
			{
				$this->loadIndex();
			} else {
				$filename = CONTROLLER_PATH.$url[0].'.php';
				if (!file_exists($filename))
				{
					$this->loadNotFound();
				} else {
					require_once $filename;
					if (!class_exists($url[0]))
					{
						$this->loadNotFound();
					} else {
						$controller = new $url[0];
						
						if (!isset($url[1]))
						{
							$action = 'indexAction';
						} else {
							$action = $url[1].'Action';
						}
						if (!method_exists($controller, $action))
						{
							$this->loadNotFound();
						} else {
							$controller->{$action}();
						}
					}
				}
			}
		}
	}

	public function loadView($filename, array $params = array())
	{
		$viewfile = VIEW_PATH . $filename .'.php';
		if (file_exists($viewfile)){
			ob_start();
			extract($params);
			require $viewfile;
			return ob_get_clean();
		} else {
			throw new Exception("file view " . $filename . " tidak ditemukan");
		}
	}

	public function loadModel($model)
	{
		$modelfile = MODEL_PATH . $model . '.php';
		if (file_exists($modelfile)){
			require_once $modelfile;
			if (class_exists($model)){
				$modelname = strtolower($model);
				$this->{$modelname} = new $model();
			} else {
				throw new Exception("file model " . $model . " tidak ditemukan");
			}
		} else {
			throw new Exception("file model " . $model . " tidak ditemukan");
		}
	}

	public function uri_segment($index = 0)
	{
		if (isset($_GET['url']))
		{
			$url = filter_var($_GET['url'], FILTER_SANITIZE_URL);
			$url = trim($url, '/');
			$url = explode('/', $url);
			return $url[$index];
		} else {
			return false;
		}
	}
}
