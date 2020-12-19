<?php
namespace app\core;

class Database {

	public static \PDO $pdo;
	public function __construct(array $config=[]){

		$dsn=$config['dsn'];
		$user=$config['user'];
		$pass=$config['pass'];
		self::$pdo=new \PDO($dsn,$user,$pass);
		self::$pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
	}

	public function applyMigrations(){

		$newMigrationsArr=[];
		$this->setMigrationsTable();
		$appliedMigrations=$this->appliedMigrations();

		$files=scandir(Application::$ROOT_DIR.'/migrations');
		$toApplyMigrations=array_diff($files, $appliedMigrations);
		foreach ($toApplyMigrations as $migration) {
			if($migration==='.' || $migration==='..'){
				continue;
			}
			include_once Application::$ROOT_DIR.'/migrations/'.$migration;
			$className=pathinfo($migration,PATHINFO_FILENAME);

			$instance=new $className(self::$pdo);
			
			$newMigrationsArr[]=$migration;
			$this->setMsg("Applying for migration $migration");
			$instance->up();
			$this->setMsg("Applied Migration $migration");
		}

		if(!empty($newMigrationsArr)){
			$this->saveMigrations($newMigrationsArr);
		} else {
			$this->setMsg("All migrations are applied");
		}
		//echo "<pre>";
		//var_dump($toApplyMigrations);
		//echo "</pre>";exit;
	}//end

	private function saveMigrations(array $migrations){

		$migration=array_map(function($m){

			return "('{$m}')";
		}, $migrations);

		$strImplo=implode(',', $migration);
		
		$SQL="INSERT INTO migrations(migration)values{$strImplo};";
		
		$stm=self::$pdo->prepare($SQL);
		$stm->execute();

	}

	private  function setMigrationsTable(){

		self::$pdo->exec("CREATE TABLE IF NOT EXISTS migrations(

			id int not null auto_increment primary key,
			migration varchar(255) not null,
			create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP


	)ENGINE=INNODB;");

	} //end
	private function appliedMigrations(){

		$SQL="SELECT migration FROM migrations;";
		$stm=self::$pdo->prepare($SQL);
		$stm->execute();
		return $stm->fetchAll(\PDO::FETCH_COLUMN);


	}
	private function setMsg(string $msg){

		echo $msg.PHP_EOL;
	}
}



?>
