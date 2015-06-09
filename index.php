<?php
	session_start();
	// $_SESSION['id']=1; // a supprimer
	
	require('config.php');

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

	$liste = array("category_list", "user","produit_single_commentaire_add", "produit_single","login","administration","produit_add", "produit_modif", "produit_suppr", "produit_modif_affich", "produit_suppr_affich", "panier_valid", "commande_valid");

	$liste_ajax = array("user_adresse_modif", "produit_single","produit_modif", "user_modif","produit_suppr","admin_user_modif_affich","produit_search_site", "login", "user_add", "produit_search", "panier", "user_search_site", "user_adresse_add");



if (isset($_GET['ajax']) && !empty($_GET['ajax']) && in_array($_GET['ajax'], $liste_ajax)){
	$page = $_GET['ajax'];
	require('apps/'.$page.'.php');
}
else
{

	$page = 'home';
	if (isset($_GET['page']) && !empty($_GET['page']) && in_array($_GET['page'], $liste)){
		$page = $_GET['page'];
	}
	
	
	// }

	// if (isset($_GET['id_produit'])){
	// 	$id_produit = $_GET['id_produit'];
	// }
	// if (isset($_GET['id_user'])){
	// 	$id_user = $_GET['id_user'];
	// }

	require('./views/skel.phtml');}


?>