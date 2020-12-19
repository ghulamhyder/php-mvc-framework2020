<?php


class m0001_initial {

	public \PDO $pdo;
	public function __construct($pdo){
		$this->pdo=$pdo;
	}
	
	public function up(){

		$SQL="CREATE TABLE if not exists users(
				
			id int not null auto_increment primary key,
			fname varchar(255) not null,
			lname varchar(255) not null,
			email varchar(255) not null,
			status tinyint not null,
			create_at timestamp default current_timestamp

		
	)ENGINE=INNODB;";

		$this->pdo->exec($SQL);
	}

	public function down(){
		$SQL="DROP TABLE users";
		$this->pdo->exec($SQL);
		
	}
}



?>