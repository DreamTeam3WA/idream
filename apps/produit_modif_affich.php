<?php
$id_produit=$_GET['id_produit'];
if (isset($_GET['id_produit'])) {
	$id_produit = $_GET['id_produit'];
	$tab = $db->query("SELECT * FROM produit WHERE id_produit=".$id_produit)->fetch(PDO::FETCH_ASSOC);
	if (isset($tab['nom_produit']) && !empty($tab['nom_produit']) &&
		 isset($tab['date']) && !empty($tab['date']) && 
		 isset($tab['prix']) && !empty($tab['prix']) &&
		 isset($tab['description']) && !empty($tab['description']) && isset($tab['id_category']) && !empty($tab['id_category']) && isset($tab['reference']) && !empty($tab['reference'])){
		$nom_produit = htmlentities($tab['nom_produit']);
		$date = $tab['date'];
		$prix = $tab['prix'];
		$lien0 = htmlentities($tab['lien']);
		$description = htmlentities($tab['description']);
		$id_category = $tab['id_category'];
		$reference = $tab['reference'];
		require('./views/produit_modif.phtml');
	}
	else {
		$commentaire = "Erreur lecture base de données";
		require('./views/erreur.phtml');
		die();
	}
}

?>