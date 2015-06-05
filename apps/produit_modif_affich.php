<?php
if (droits() == 1 || droits() == 2){
	if (isset($_POST['action']) && $_POST['action']=="produit_modif_submit"){ 
		if(isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['reference']) && !empty($_POST['reference']) && isset($_POST['category']) && !empty($_POST['category']) && isset($_POST['prix']) && !empty($_POST['prix']) && isset($_POST['description']) && !empty($_POST['description']) && isset($_POST['id_produit']) && !empty($_POST['id_produit'])){
					$id_produit =$db->quote($_POST['id_produit']);
					$nom_produit = $db->quote($_POST['nom']);
					$category = $db->quote($_POST['category']);
					$reference = $db->quote($_POST['reference']);
					$prix = $db->quote($_POST['prix']);
					$description = $db->quote($_POST['description']);
					$db-> exec("UPDATE produit SET nom_produit=".$nom_produit.", reference=".$reference.", prix=".$prix.", description=".$description.", id_category=".$category.", duree=15. WHERE id_produit=".$id_produit);
				$db->exec("DELETE FROM img WHERE id_produit=".$id_produit);
				$i=0;
				while(isset($_POST["lien".$i]) && !empty($_POST["lien".$i]))
				{	
					$lien = $db->quote($_POST["lien".$i]);
					$db-> exec("INSERT INTO img SET lien=".$lien.", id_produit=".$id_produit);
					$i++;
				}
				$j=0;
				while(isset($_POST["id_img".$j]) && !empty($_POST["id_img".$j]))
				{	
					$lien = $db->quote($_POST["id_img".$j]);
					$db-> exec("INSERT INTO img SET lien=".$lien.", id_produit=".$id_produit);
					$j++;
				}
				$erreur="Le produit ".$nom_produit." a été modifié !";
				require('./views/erreur.phtml');
				die();
		}
		else {
			$erreur="Le formulaire est incomplet !";
			require('./views/erreur.phtml');
			}
	}
	require('./views/produit_modif_affich.phtml');
}
else {
	$erreur="Vous n'avez pas les droits. ";
		require('./views/erreur.phtml');
	}
?>