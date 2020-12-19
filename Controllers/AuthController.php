<?php
namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\core\Application;
use app\models\UserRegisterModel;
use app\models\LoginForm;

class AuthController extends Controller{

	public UserRegisterModel $userModel;
	public function __construct(){
		$this->userModel=new UserRegisterModel();
		$this->loginForm=new LoginForm();
	}

	public function login(Request $request,Response $response){

		$data=[

			'title'=>'User Signin',
			'model'=>$this->loginForm,

		];
			if($request->isPost()){

				$this->loginForm->loadData($request->getBody());

				if($this->loginForm->validate() && $this->loginForm->login()){
				Application::$app->session->setFlashMsg('success','You have been successfully login');
				$response->redirect('/');
				}

			}

		$this->setLayOut('auth');
		return $this->render('login',$data);

	}//end

	public function register(Request $request,Response $response){

		$data=[

			'title'=>'Create An Account',
			'body'=>'this is body page',
			'model'=>$this->userModel,

		];
			if($request->isPost()){

				$this->userModel->loadData($request->getBody());
				if($this->userModel->validate() && $this->userModel->save()){
					Application::$app->session->setFlashMsg('success','Thanks for Regsitering!');
					$response->redirect('/');


				}
				$this->setLayOut('auth');
				return $this->render('register',$data);
			}
			$this->setLayOut('auth');
		return $this->render('register',$data);
	}

	public function logout(Request $request,Response $response){
		 Application::$app->logout();
		 Application::$app->session->setFlashMsg('success','you have been logout!');
		 return $response->redirect('/');
	}

}


?>