<?php
namespace app\core;
use app\core\Model;
use app\core\Application;

Abstract class DbModel extends Model{

	Abstract public static function tableName():string;
	Abstract public function attributes():array;
	Abstract public function primaryKey():string;

	public function save(){

			$tableName=$this->tableName();
			$attributes=$this->attributes();
			$params=array_map(function($attri){
				return ":$attri";
			},$attributes);
			$strAttri=implode(',',$attributes);
			$strParams=implode(',',$params);

			$SQL="INSERT INTO {$tableName}($strAttri)values({$strParams});";
			$stm=self::prepare($SQL);
			foreach ($attributes as $attri) {
				$stm->bindValue(":{$attri}",$this->{$attri});
			}
			$stm->execute();
			return true;

	}//end



	public function findOne(array $where){

		$tableName=static::tableName();

		$attributes=array_keys($where);

		$strAttri=array_map(function($attri){

				return " $attri=:$attri ";
		}, $attributes);
		
		$AttriImplo=implode('AND', $strAttri);

		$SQL="SELECT * FROM {$tableName} WHERE {$AttriImplo};";
		$stm=self::prepare($SQL);
		foreach ($where as $key => $value) {
				$stm->bindValue(":{$key}",$value);	
		}
		
		$stm->execute();
		return $stm->fetchObject(static::class);

	}























	/*public function findOne(array $where){

			$tableName=static::tableName();

			$atrribute=array_keys($where);

			$strMap=array_map(function($attri){
				return "$attri=:$attari";

			}, $attribute);
			$strImplo=implode('AND',$strMap);
			$sql="SELECT * FROM {tableName} WHERE {$strImplo};";
			$stm=self::prepare($sql);
			foreach ($where as $key => $value) {
				$stm->bindValue(":{$key}",$value);
			}
			$stm->execute();
			return $stm->fetchObject(static::class);
	}*/


	public static function prepare($sql){
		return Application::$app->db::$pdo->prepare($sql);
	}


}




?>