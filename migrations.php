<?php

	use app\core\Application;
	
	include_once __DIR__.'./vendor/autoload.php';

	$dotEnv=Dotenv\Dotenv::createImmutable(__DIR__);
	$dotEnv->load();

$config=[

		'db'=>[

			'dsn'=>$_ENV['DB_DSN'],
			'user'=>$_ENV['DB_USER'],
			'pass'=>$_ENV['DB_PASSWORD'],

		]


	];


	$app=new Application(__DIR__,$config);



	$app->db->applyMigrations();
?>