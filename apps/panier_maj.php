<?php
if (isset($_GET['id_produit'])){
	$id_produit = $_GET['id_produit'];
	// $id_produit=$db->quote($id_produit);
	$tab = $db->query("SELECT produit.*, panier.quantity
	FROM produit
	JOIN panier ON produit.id_produit=panier.id_produit
	WHERE produit.id_produit=".$id_produit )->fetchAll(PDO::FETCH_ASSOC);
	if (isset($tab) && !empty($tab)) {

		$quantity = 1;
		$nom_produit = htmlentities($tab[0]['nom_produit']);
		$reference = htmlentities($tab[0]['reference']);
		$duree = $tab[0]['duree'];
		$prix = $tab[0]['prix'];
		require('./views/panier_maj.phtml');
	}

	else {
	$erreur="Produit non trouvé. ";
	require('./views/erreur.phtml');
	die();
	}
}
else {
	$erreur="Vous n'avez pas le droit d'accéder directement sans passer par la page d'accueil en haut à gauche, angle 180° à droite de là bas, en haut enfin tu vois ce que je veux dire non ?";
	require('./views/erreur.phtml');
}


?>