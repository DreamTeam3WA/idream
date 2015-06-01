<?php
if (isset($id_produit)) {
	// $id_produit=$db->quote($id_produit);
	$tab = $db->query("SELECT produit.*, avis.*, user.prenom
	FROM produit
	LEFT JOIN avis ON produit.id_produit = avis.id_produit
	LEFT JOIN user ON avis.id_user = user.id_user
	WHERE produit.id_produit=".$id_produit )->fetchAll(PDO::FETCH_ASSOC);
	if (isset($tab) && !empty($tab)) {

		$nom_produit = htmlentities($tab[0]['nom_produit']);
		$reference = htmlentities($tab[0]['reference']);
		$date = $tab[0]['date'];
		$description = htmlentities($tab[0]['description']);
		$duree = $tab[0]['duree'];
		$prix = $tab[0]['prix'];

		require('./views/produit_single.phtml');

		$i=0;
		while(isset($tab[$i])){
			$note = $tab[$i]['note'];
			$commentaires = htmlentities($tab[$i]['commentaires']);
			$date = $tab[$i]['date'];
			$prenom = htmlentities($tab[$i]['prenom']);
			require('./views/produit_commentaire.phtml');
			$i++;
		}
		require('./views/produit_single_end.phtml');
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