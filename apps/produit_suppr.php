<?php
if (droits() == 1)
{
	if (isset($_GET['id_produit'])) {
		$id_produit=$_GET['id_produit'];
		$tab = $db->query("SELECT * FROM produit WHERE id_produit=".$id_produit)->fetch(PDO::FETCH_ASSOC);
		if (isset($tab['nom_produit']) && !empty($tab['nom_produit'])){
			$nom_produit = htmlentities($tab['nom_produit']);
			$date = $tab['date'];
			$prix = $tab['prix'];
			$id_produit = $tab['id_produit'];
			$description = htmlentities($tab['description']);
			$id_category = $tab['id_category'];
			$reference = $tab['reference'];
		require('./views/produit_suppr_confirmation.phtml');
	}
	}
	else {
		$nom_produit=1;
		require('./views/produit_suppr.phtml');
	}
}
else {
	$erreur= "Vous n'avez pas les droits";
	require('./views/erreur.phtml');
}
?>