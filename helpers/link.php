<?php

function linkCss($cssPath){

		$fullPath=baseUrl.'/'.$cssPath;

		echo "<link rel='stylesheet' type='text/css' href='{$fullPath}'>";

}

?>
