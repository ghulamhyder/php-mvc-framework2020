<?php
namespace app\core;
//use app\models\UserRegisterModel;


class Application {



	public Router $router;
	public Request $request;
	public Response $response;
	public Session $session;
	public static string $ROOT_DIR;
	public static Application $app;
	public Controller $controller;
	public Database $db;
	public ?DbModel $user;
	public string $userClass;

	public function __construct(string $rootPath,array $config=[]){

		self::$ROOT_DIR=$rootPath;
		self::$app=$this;
		$this->userClass=$config['userClass'];
		$this->request=new Request();
		$this->response=new Response();
		
		$this->session=new Session();
		$this->router=new Router($this->request,$this->response);
		$this->db=new Database($config['db']);


		$primaryGetVal=$this->session->get('user');
		if($primaryGetVal){

			$primaryKey=$this->userClass::primaryKey();
			$this->user=$this->userClass::findOne([$primaryKey=>$primaryGetVal]);

		} else {

			$this->user=null;
		}


	}

	public function login(DbModel $user){

		$this->user=$user;
		$primaryKey=$user->primaryKey();
		$primaryValue=$user->{$primaryKey};
		$this->session->set('user',$primaryValue);
		return true;

	}

	public function run(){
		echo $this->router->resolve();
	}

	public function isGuest(){
		return !self::$app->user;
	}

	public function logout(){
		 $this->user=null;
		 self::$app->session->remove('user');

	}

	
}


?>