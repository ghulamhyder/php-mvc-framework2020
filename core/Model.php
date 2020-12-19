<?php
namespace app\core;

Abstract class Model {

	public const RULE_REQUIRED='required';
	public const RULE_EMAIL='email';
	public const RULE_MIN='min';
	public const RULE_MAX='max';
	public const RULE_MATCH='match';
	public const RULE_UNIQUE='unique';
	public array $error=[];


	Abstract public static function prepare($sql);
	Abstract public function rules():array;
	Abstract public function labels():array;


	



	public function loadData($udata=[]){

		foreach ($udata as $attribute => $value) {
			
			$this->{$attribute}=$value;

		}
	}

	public function validate(){
				
		foreach ($this->rules() as $attribute => $rules) {
			$value=$this->{$attribute};
			foreach ($rules as $rule) {
				$ruleName=$rule;

			if(is_array($ruleName)){
				$ruleName=$rule[0];
			}

			if($ruleName===self::RULE_REQUIRED && !$value){
				$this->addError($attribute,self::RULE_REQUIRED);
			}
			if($ruleName===self::RULE_EMAIL && !filter_var($value,FILTER_VALIDATE_EMAIL)){
				$attribute=ucfirst($attribute);
				$this->addError($attribute,self::RULE_EMAIL,['field'=>$attribute]);
			}
			if($ruleName===self::RULE_MIN && strlen($value) < $rule['min'] ){
				$this->addError($attribute,self::RULE_MIN,$rule);
			}
			if($ruleName===self::RULE_MAX && strlen($value) > $rule['max'] ){
				$this->addError($attribute,self::RULE_MAX,$rule);
			}
			if($ruleName===self::RULE_MATCH && $value != $this->{$rule['match']} ){
					$rule['match']=ucfirst($rule['match']);
				$this->addError($attribute,self::RULE_MATCH,['field'=>$rule['match']]);
			}
			if($ruleName===self::RULE_UNIQUE){

				$className=$rule['class'];
				$tableName=$className::tableName();
				$uniAttri=$rule['attribute'] ?? $attribute;
				$SQL="SELECT * FROM {$tableName} WHERE {$uniAttri}=:attri;";
				$stm=static::prepare($SQL);
				$stm->bindValue(':attri',$value);
				$stm->execute();
				$record=$stm->fetchObject();
				if($record){
					$this->addError($attribute,self::RULE_UNIQUE,['field'=>ucfirst($attribute)]);
				} else {
						return true;
				}



			}
			}//innerloop
		}//outerloop
		return empty($this->error);
	}//End

	public function hasError($attribute){

		return $this->error[$attribute] ?? false;
	}
	public function getFirstErrorMsg($attribute){

		return $this->error[$attribute][0] ?? '';
	}

	protected function addError(string $attribute,string $ruleKey,array $rule=[]){


		$message=$this->errorMessages()[$ruleKey] ?? '';
		foreach ($rule as $key => $value) {
			$message=str_replace("{{$key}}",$value,$message);
		}
		$this->error[$attribute][]=$message;
	}

	protected function addErrorRuleMsg(string $attribute,string $msg){

			$this->error[$attribute][]=$msg;
		
	}
	protected function errorMessages():array{
		return [

			self::RULE_REQUIRED=>'This Field is required',
			self::RULE_EMAIL=>'This Field is invalid {field}',
			self::RULE_MIN=>'This Field is required minimum {min} chars',
			self::RULE_MAX=>'This Field is required maximum {max} chars',
			self::RULE_MATCH=>'{field} did not match',
			self::RULE_UNIQUE=>'this record of {field} is already exists',
		];
	}
}//class


?>