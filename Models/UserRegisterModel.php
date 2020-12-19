<?php
namespace app\models;
use app\core\UserModel;

class UserRegisterModel extends UserModel {

		public string $fname='';
		public string $lname='';
		public string $email='';
		public int $status=0;
		public string $password='';
		public string $pass2='';

		public function save(){

				$this->password=password_hash($this->password, PASSWORD_BCRYPT,['cost'=>8]);
			return parent::save();
		}

		public static function tableName():string{
			return "users";
		}
		public function attributes():array{

			return ['fname','lname','email','status','password'];
		}

		public function primaryKey():string {
				return 'id';
		}
		public function labels():array{
			return [
				'fname'=>'First Name',
				'lname'=>'Last Name',
				'email'=>'Email',
				'password'=>'Password',
				'pass2'=>'Confirm-Password',

				


			];
		}
		
		public function UserDisplayName():string{

			return $this->fname.' '.$this->lname;
		}
		public function rules():array {

			return [

				'fname'=>[self::RULE_REQUIRED],
				'lname'=>[self::RULE_REQUIRED],
				'email'=>[self::RULE_REQUIRED,self::RULE_EMAIL,[self::RULE_UNIQUE,'class'=>self::class]],
				'password'=>[self::RULE_REQUIRED,[self::RULE_MIN,'min'=>8],[self::RULE_MAX,'max'=>24] ],
				'pass2'=>[self::RULE_REQUIRED,[self::RULE_MATCH,'match'=>'password'] ],

			];
		}
}


?>