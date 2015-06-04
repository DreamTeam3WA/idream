<?php
	session_start();
	// $_SESSION['id']=1; // a supprimer
	
	$db = new PDO("mysql:dbname=dreamcommerce;host=10.32.195.200", 'idream', 'troiswa');
	$db->exec("SET CHARACTER SET utf8");

	require('./apps/function.php');
	require('./models/User.class.php');


	if(isset($_GET['logout']) && $_GET['logout']==1){
		$_SESSION = array();
		session_destroy();
		header('Location: index.php?page=home');
		die();	
	}
	if(isset($_SESSION['id_user'])){
		$USER = $db->query("SELECT * FROM user
	WHERE id_user =".$_SESSION['id_user'])->fetchObject('User');
	}

	$liste = array("category_list", "user_single","produit_single_commentaire_add", "produit_single","login","administration","produit_add", "produit_modif", "produit_suppr", "produit_modif_affich");

if (isset($_GET['ajax']))
{
	$page = $_GET['ajax'];
	require('apps/'.$page.'.php');
}
else
{

	$page = 'home';
	if (isset($_GET['page']) && !empty($_GET['page']) && in_array($_GET['page'], $liste)){
		$page = $_GET['page'];
	}
	
	


	if (isset($_GET['id_category'])){
		$id_category = $_GET['id_category'];
	}

	// if (isset($_GET['id_produit'])){
	// 	$id_produit = $_GET['id_produit'];
	// }
	if (isset($_GET['id_user'])){
		$id_user = $_GET['id_user'];
	}

	require('./views/skel.phtml');}
?>