<?php
	session_start();
	
	$db = new PDO("mysql:dbname=dreamcommerce;host=10.32.195.220", 'idream', 'troiswa');
	$db->exec("SET CHARACTER SET utf8");

	$page = 'home';
	if (isset($_GET['page']) && !empty($_GET['page'])){
		$page = $_GET['page'];
	}
	require('./views/skel.phtml');
?>