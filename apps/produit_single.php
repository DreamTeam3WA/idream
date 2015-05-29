<?php
if (isset($id_produit)) {
	$id_produit=$db->quote($id_produit);
	$tab = $db->query("SELECT produit.* , img.lien
	FROM produit
	JOIN img ON produit.id_produit = img.id_produit
	WHERE id_produit= ".$id_produit )->fetch(PDO::FETCH_ASSOC);
	if (isset($tab) && !empty($tab)) {
		$lien = $tab['lien'];
		$id_produit = $tab['id_produit'];
		$nom = htmlentities($tab['nom']);
		$reference = htmlentities($tab['reference']);
		$date = $tab['date'];
		$description = $tab['description'];
		$duree = $tab['duree'];
		$prix = $tab ['prix'];
	}
	else {
	$erreur="Sujet non trouvé. ";
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