<?php
namespace app\core;
use app\core\DbModel;

Abstract class UserModel extends DbModel{

	Abstract public function UserDisplayName():string;

	
}



?>