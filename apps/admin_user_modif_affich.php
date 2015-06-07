<?php
if (isset($_GET['id_user'])) {
	$id_user=$_GET['id_user'];
	$tab = $db->query("SELECT * FROM user WHERE id_user=".$id_user)->fetch(PDO::FETCH_ASSOC);
	if (isset($tab['nom']) && !empty($tab['nom']) &&
		 isset($tab['date_naissance']) && !empty($tab['date_naissance'])  &&
		 isset($tab['prenom']) && !empty($tab['prenom']) && isset($tab['email']) && !empty($tab['email']) && isset($tab['telephone']) && !empty($tab['telephone']) && isset($tab['droits']) && !empty($tab['droits'])){
		$nom = htmlentities($tab['nom']);
		$date_naissance = $tab['date_naissance'];
		$prix = $tab['prix'];
		$id_user = $tab['id_user'];
		$prenom = htmlentities($tab['prenom']);
		$email = $tab['email'];
		$telephone = $tab['telephone'];
		$droits = $tab['droits'];
		require('./apps/produit_modif_affich.php');
	}
	else {
		$erreur = "Erreur lecture base de données";
		require('./views/erreur.phtml');
		die();
	}
}
else {
	$nom_produit = "L'utilisateur n'est pas renseigné";
	$date = "L'utilisateur n'est pas renseigné";
	$prix = "L'utilisateur n'est pas renseigné";
	$lien0 = "L'utilisateur n'est pas renseigné";
	$description = "L'utilisateur n'est pas renseigné";
	$id_category = "L'utilisateur n'est pas renseigné";
	$reference = "L'utilisateur n'est pas renseigné";
	require('./views/produit_modif.phtml');
	$id_produit=0;
	require('./apps/produit_modif_affich.php');
}
?>