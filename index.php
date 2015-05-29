<?php
	session_start();
	
	$db = new PDO("mysql:dbname=dreamcommerce;host=127.0.0.1", 'root', 'troiswa');
	$db->exec("SET CHARACTER SET utf8");

	$page = 'home';
	if (isset($_GET['page']) && !empty($_GET['page'])){
		$page = $_GET['page'];
	}
	if (isset($_GET['id_category'])){
		$id_category = $_GET['id_category'];
	}
	if (isset($_GET['id_produit'])){
		$id_produit = $_GET['id_produit'];

	}
	require('./views/skel.phtml');
?>