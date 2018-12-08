<?php 
spl_autoload_register(function($class_name){

	$filename ="class".DIRECTORY_SEPARATOR.$class_name.".php";

	// se o arquivo existe inclui ele
	if(file_exists(($filename))){
		require_once($filename);
	}

});

 ?>