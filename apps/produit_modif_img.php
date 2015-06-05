<?php
if (isset($id_produit)) {
	// $id_produit=$db->quote($id_produit);
	$tab2 = $db->query("SELECT produit.*, img.*
	FROM produit
	RIGHT JOIN img ON produit.id_produit = img.id_produit
	WHERE produit.id_produit= ".$id_produit )->fetchAll(PDO::FETCH_ASSOC);
	$i=0;
	if (isset($tab2[$i]) && !empty($tab2[$i])) {
		while(!empty($tab2[$i]["lien"])){
			$id_produit = $tab2[$i]['id_produit'];
			$img = $tab2[$i]["lien"];
			$id_img = $tab2[$i]["id_img"];
			require('./views/produit_modif_img.phtml');
			$i++;
		}
	}
}
else{
	$erreur = "Aucune image à afficher";

}

?>