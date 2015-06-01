<?php
if (isset($id_produit)) {
	$id_produit=$db->quote($id_produit);
	$tab = $db->query("SELECT produit.*, img.lien, avis.*, user.prenom
	FROM produit
	JOIN img ON produit.id_produit = img.id_produit
	JOIN avis ON produit.id_produit = avis.id_produit
	JOIN user ON avis.id_user = user.id_user
	WHERE produit.id_produit= ".$id_produit )->fetchAll(PDO::FETCH_ASSOC);
	if (isset($tab) && !empty($tab)) {

		$lien = $tab[0]['lien'];
		$id_produit = $tab[0]['id_produit'];
		$nom_produit = htmlentities($tab[0]['nom_produit']);
		$reference = htmlentities($tab[0]['reference']);
		$date = $tab[0]['date'];
		$description = htmlentities($tab[0]['description']);
		$duree = $tab[0]['duree'];
		$prix = $tab[0]['prix'];
		$note = $tab[0]['note'];
		$commentaires = htmlentities($tab[0]['commentaires']);
		$date = $tab[0]['date'];
		$prenom = htmlentities($tab[0]['prenom']);
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
require('./views/produit_single.phtml');

?>