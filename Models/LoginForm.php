<?php
namespace app\models;
use app\core\Model;
use app\core\Application;

class LoginForm extends Model{

		
			public string $email='';
			public string $password='';



		public function labels():array{

				return [
						'email'=>'Your Email',
						'password'=>'Password',

				];
		}


		public function rules():array {

				return [
				'email'=>[self::RULE_REQUIRED],
				'password'=>[self::RULE_REQUIRED],
			];
		}//end


	public static function prepare($sql) {

	} 

	public function login(){

			$user=UserRegisterModel::findOne(['email'=>$this->email]);
			if(!$user){
				$this->addErrorRuleMsg('email','User Does not exists with this email');
				return false;
			} 
			if(!password_verify($this->password, $user->password)){

				$this->addErrorRuleMsg('password','invlaid password');
				return false;

			}

			return Application::$app->login($user);
	}//end


}



?>