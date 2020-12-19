<?php
namespace app\controllers;
use app\core\Controller;

class SiteController extends Controller{

	public function home(){

		$data=[
			'title'=>'Welcome Codelic ',

		];
		return $this->render('home',$data);
	}

	

}


?>