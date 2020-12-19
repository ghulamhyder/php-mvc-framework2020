<?php
namespace app\core\form;

class Field {

	const TYPE_TEXT='text';
	const TYPE_EMAIL='email';
	const TYPE_PASSWORD='password';
	const TYPE_NUM='number';

	public $model;
	public string $attribute;
	public string $type;
	public function __construct($model,$attribute){
		$this->type=self::TYPE_TEXT;
		$this->model=$model;
		$this->attribute=$attribute;

	}

	public function __toString(){

		return sprintf("  
	
			<div class='form-group'>
				<label>%s</label>
				<input type='%s' class='form-control%s' value='%s' name='%s' placeholder='%s..'>
				<span class='invalid-feedback'>
					%s
				</span>
			</div>",
					$this->model->labels()[$this->attribute],
					$this->type,
					$this->model->hasError($this->attribute) ? ' is-invalid' : '',
					$this->model->{$this->attribute},
					$this->attribute,
					$this->model->labels()[$this->attribute],
					$this->model->getFirstErrorMsg($this->attribute)
						);


	}

	

}//end




?>
