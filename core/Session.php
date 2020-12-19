<?php
namespace app\core;

class Session {

	public const FLASH_KEY='flash_messages';

	public function __construct(){
				session_start();
			$flashMessages=$_SESSION[self::FLASH_KEY] ?? [];
			foreach ($flashMessages as $key => &$fMsg) {
					$fMsg['remove']=true;
			}
			$_SESSION[self::FLASH_KEY]=$flashMessages;

	}//end


	public function setFlashMsg($key,$msg){

		$_SESSION[self::FLASH_KEY][$key]=[

						'remove'=>false,
						'value'=>$msg,
						];
					

	}//end

	public function getFlashMsg($key){

		return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
	}//end

	public function set($key,$value){
			$_SESSION[$key]=$value;
	}
	public function get($key){
			return $_SESSION[$key] ?? false;
	}
	public function remove($key){
			unset($_SESSION[$key]);
	}

	public function __destruct(){

		$flashMessages=$_SESSION[self::FLASH_KEY] ?? [];
			foreach ($flashMessages as $key => &$fMsg) {
					if($fMsg['remove']){
						unset($flashMessages[$key]);
					}
			}
			$_SESSION[self::FLASH_KEY]=$flashMessages;
	}


}



?>