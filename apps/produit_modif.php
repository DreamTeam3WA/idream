<?php
if (isset($_GET['id_produit'])) {
	$id_produit=$_GET['id_produit'];
	$tab = $db->query("SELECT * FROM produit WHERE id_produit=".$id_produit)->fetch(PDO::FETCH_ASSOC);
	if (isset($tab['nom_produit']) && !empty($tab['nom_produit']) &&
		 isset($tab['date']) && !empty($tab['date']) && 
		 isset($tab['prix']) && !empty($tab['prix']) &&
		 isset($tab['description']) && !empty($tab['description']) && isset($tab['id_category']) && !empty($tab['id_category']) && isset($tab['reference']) && !empty($tab['reference'])){
		$nom_produit = htmlentities($tab['nom_produit']);
		$date = $tab['date'];
		$prix = $tab['prix'];
		$description = htmlentities($tab['description']);
		$id_category = $tab['id_category'];
		$reference = $tab['reference'];
		$tabimage= $db-> query("SELECT img.lien FROM img WHERE id_produit=".$id_produit);
		// $i=0;
		// 		while(isset($tabimage["lien".$i]) && !empty($tabimage["lien".$i]))
		// 		{	
		// 			$lien = $db->quote("./images/".$tabimage["lien".$i]);
					
		// 			$i++;
		// 		}
		require('./views/produit_modif.phtml');
	}
	else {
		$commentaire = "Erreur lecture base de données";
		require('./views/erreur.phtml');
		die();
	}
}
else {
	$nom_produit = "Le produit n'est pas renseigné";
	$date = "Le produit n'est pas renseigné";
	$prix = "Le produit n'est pas renseigné";
	$lien0 = "Le produit n'est pas renseigné";
	$description = "Le produit n'est pas renseigné";
	$id_category = "Le produit n'est pas renseigné";
	$reference = "Le produit n'est pas renseigné";
	
	require('./views/produit_modif.phtml');
}
?>