<?php

	try{
		$db = new PDO("mysql:dbname=dreamcommerce;host=10.32.195.200", 'idream', 'troiswa');
		$db->exec("SET CHARACTER SET utf8");
	}	
	catch (Exception $e){
		die('Erreur : '.$e->getMessage());
	}


?>