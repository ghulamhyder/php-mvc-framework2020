<?php


class m0002_Add_password {

	public \PDO $pdo;
	public function __construct($pdo){
		$this->pdo=$pdo;
	}
	public function up(){
		$SQL="ALTER TABle users 
		ADD COLUMN password VARCHAR(255) NOT NULL;";

		$this->pdo->exec($SQL);

	}

	public function down(){
		$SQL="ALTER TABle users 
			DROP COLUMN password;";

		$this->pdo->exec($SQL);
		
	}
}



?>