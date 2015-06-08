<?php
if (isset($_GET['id_user'])) {
	$id_user=$_GET['id_user'];
	$tab = $db->query("SELECT * FROM user WHERE id_user=".$id_user)->fetch(PDO::FETCH_ASSOC);
	if (isset($tab['nom']) && !empty($tab['nom']) &&
		 isset($tab['prenom']) && !empty($tab['prenom']) && isset($tab['email']) && !empty($tab['email']) && isset($tab['droits']) && !empty($tab['droits'])){
		$nom = htmlentities($tab['nom']);
		$date_naissance = $tab['date_naissance'];
		$id_user = $tab['id_user'];
		$prenom = htmlentities($tab['prenom']);
		$email = $tab['email'];
		$telephone = $tab['telephone'];
		$droits = $tab['droits'];
		require('./views/admin_user_modif_affich.phtml');
	}
	else {
		$erreur = "Erreur lecture base de données";
		require('./views/erreur.phtml');
		die();
	}
}
else {
	$nom = "L'utilisateur n'est pas renseigné";
	$date_naissance = "L'utilisateur n'est pas renseigné";
	$prix = "L'utilisateur n'est pas renseigné";
	$id_user = "L'utilisateur n'est pas renseigné";
	$prenom = "L'utilisateur n'est pas renseigné";
	$email = "L'utilisateur n'est pas renseigné";
	$telephone = "L'utilisateur n'est pas renseigné";
	$droits = "L'utilisateur n'est pas renseigné";
	$id_produit=0;
	require('./views/admin_user_modif_affich.phtml');
}
?>