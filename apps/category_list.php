<?php

if (isset($_GET['id_category']) && !empty($_GET['id_category']) && intval($_GET['id_category'])) {

	$id_category = $_GET['id_category'];
	
	$tab=$db->query("SELECT produit.id_produit, produit.nom_produit, produit.description, produit.prix, img.lien
 	FROM produit
 	JOIN img ON produit.id_produit = img.id_produit
 	WHERE id_category=".$id_category."
 	GROUP BY produit.id_produit");
	$tab = $tab->fetchAll(PDO::FETCH_ASSOC);

	$i=0;
	if (!empty($tab[$i])){
		while (isset($tab[$i])) {
		$lien = ($tab[$i]['lien']);
		$nom = htmlentities($tab[$i]['nom_produit']);
		$description = htmlentities($tab[$i]['description']);
		$prix = htmlentities($tab[$i]['prix']);
		$id_produit = $tab[$i]['id_produit'];
		require ("views/category_list.phtml");
		$i++;
		}
	}
	else{
		$erreur = "Aucun produit trouvé !";
		require ("views/erreur.phtml");
	}
}
else{
	$erreur = "Page non trouvée !";
	require ("views/erreur.phtml");
}

?>