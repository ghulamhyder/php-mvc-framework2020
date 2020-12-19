<?php
namespace app\core;
use app\core\Application;

class Controller {

	public string $layout='main';
	public function setLayOut($layout){

		$this->layout=$layout;
	}

	public function render($viewName,$data=[]){
		return Application::$app->router->renderView($viewName,$data);
	}
}



?>