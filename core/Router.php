<?php
namespace app\core;
use app\core\Request;

class Router {

	public Request $request;
	public Response $response;
	protected array $myArr=[];
	public function __construct(Request $request,Response $response){
			$this->request=$request;
			$this->response=$response;
	}

	public function get($path,$callback){
		$this->myArr['get'][$path]=$callback;

	}
	public function post($path,$callback){
		$this->myArr['post'][$path]=$callback;

	}

	public function resolve(){

		$path=$this->request->getPath();
		$method=$this->request->getMethod();
		$callback=$this->myArr[$method][$path] ?? false;
		if($callback===false){
			Application::$app->response->setStatusCode(404);
			//$this->response->setStatusCode(404);
			return "not found";
		}
		if(is_string($callback)){
			return $this->renderView($callback);
		}
		if(is_array($callback)){
			Application::$app->controller=new $callback[0]();
			$callback[0]=Application::$app->controller;
			
		}
		return  call_user_func($callback,$this->request,$this->response);
	}

	public function renderView($viewName,$data=[]){

		$layoutContent=$this->layoutContent();
		$renderOnlyView=$this->renderOnlyView($viewName,$data);
		return str_replace('{{content}}', $renderOnlyView, $layoutContent);
		
	}
	protected function layoutContent(){

		$layout=Application::$app->controller->layout ?? 'main';
		ob_start();
		include_once Application::$ROOT_DIR.'./Views/layouts/'.$layout.'.php';
		return ob_get_clean();
	}
	protected function renderOnlyView($viewName,$data){
		foreach ($data as $key => $value) {
			${$key}=$value;
		}
		ob_start();
		include_once Application::$ROOT_DIR.'./Views/'.$viewName.'.php';
		return ob_get_clean();
	}
}


?>