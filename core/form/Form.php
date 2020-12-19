<?php
namespace app\core\form;
use app\core\form\Field;

class Form {

	public static function begin($action ,$method){

		echo sprintf("<form name='form1' action='%s' method='%s'>",$action,$method);
		return new Form;
	} 

	public static function end(){
		echo "</form>";
	}

	public function field($model,$attribute){

			return new Field($model,$attribute);

	}
}


?>