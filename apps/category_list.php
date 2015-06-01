<?php

if (!empty($id_category)) {
	$tab=$db->query("SELECT produit.nom_produit, produit.description, produit.prix, img.lien
 	FROM produit
 	JOIN img ON produit.id_produit = img.id_produit
 	WHERE id_category=".$id_category);
	$tab = $tab->fetchAll(PDO::FETCH_ASSOC);
	$i=0;
	if (!empty($tab[$i])){
		while (isset($tab[$i])) {
		$lien = ($tab[$i]['lien']);
		$nom = htmlentities($tab[$i]['nom_produit']);
		$description = htmlentities($tab[$i]['description']);
		$prix = htmlentities($tab[$i]['prix']);

		require ("views/categorie.phtml");
		$i++;
		}
	}
	else{
		$erreur = "Aucun produit trouvé !";
		require ("views/erreur.phtml");
	}
}
else{
	$erreur = "Catégorie non trouvée !";
	require ("views/erreur.phtml");
}

?>