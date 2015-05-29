<?php
	if (isset($id_produit)) {
	$tab = $db->query("SELECT * FROM produit WHERE id=".$id_produit)->fetch(PDO::FETCH_ASSOC);
	if (isset($tab['nom']) && !empty($tab['nom']) &&
		 isset($tab['date']) && !empty($tab['date']) && 
		 isset($tab['prix']) && !empty($tab['prix']) &&
		 isset($tab['description']) && !empty($tab['description']) && isset($tab['lien'])){
		$nom = htmlentities($tab['nom']);
		$date = $tab['date'];
		$prix = $tab['prix'];
		$lien = htmlentities($tab['lien']);
		$description = balise($tab['description']);
	}
	else {
		$commentaire = "Erreur lecture base de données";
		require('./views/erreur.phtml');
		die();
	}
	}
require('./views/produit_single.phtml');

?>