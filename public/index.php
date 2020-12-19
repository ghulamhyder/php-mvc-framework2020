<?php

	use app\core\Application;
	use app\controllers\SiteController;
	use app\controllers\AuthController;
	use app\models\UserRegisterModel;
	include_once __DIR__.'./../config/config.php';
	include_once __DIR__.'./../vendor/autoload.php';
	$dotEnv=Dotenv\Dotenv::createImmutable(dirname(__DIR__));
	$dotEnv->load();

$config=[

		'userClass'=>UserRegisterModel::class,

		'db'=>[

			'dsn'=>$_ENV['DB_DSN'],
			'user'=>$_ENV['DB_USER'],
			'pass'=>$_ENV['DB_PASSWORD'],

		]


	];
	

	$app=new Application(dirname(__DIR__),$config);

	$app->router->get('/',[SiteController::class,'home']);
	$app->router->get('login',[AuthController::class,'login']);
	$app->router->post('login',[AuthController::class,'login']);
	$app->router->get('register',[AuthController::class,'register']);
	$app->router->post('register',[AuthController::class,'register']);
	$app->router->get('logout',[AuthController::class,'logout']);

	$app->run();
?>