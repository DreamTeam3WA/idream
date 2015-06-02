<?php
	session_start();
	$_SESSION['id']=1; // a supprimer
	
	require('config.php');

	require('./apps/function.php');
	if(isset($_GET['logout']) && $_GET['logout']==1){
		$_SESSION = array();
		session_destroy();


		header('Location: index.php?page=home');
		die();	
	}

	$liste = array("category_list", "user_single","produit_single_commentaire_add", "produit_single");

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