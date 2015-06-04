<?php
if (droits() == 1 || droits() == 2){
	if (isset($_POST['action']) && $_POST['action']=="produit_add"){ 
		if(isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['reference']) && !empty($_POST['reference']) && isset($_POST['category']) && !empty($_POST['category']) && isset($_POST['prix']) && !empty($_POST['prix']) && isset($_POST['description']) && !empty($_POST['description'])){
					$nom_produit = $db->quote($_POST['nom']);
					$category = $db->quote($_POST['category']);
					$reference = $db->quote($_POST['reference']);
					$prix = $db->quote($_POST['prix']);
					$description = $db->quote($_POST['description']);
					$db-> exec("INSERT INTO produit SET nom_produit=".$nom_produit.", reference=".$reference.", prix=".$prix.", description=".$description.", id_category=".$category.", duree=15");
					$id_produit=$db->lastInsertId();
				$i=0;
				while(isset($_POST["lien".$i]) && !empty($_POST["lien".$i]))
				{	
					$lien = $db->quote("./images/".$_POST["lien".$i]);
					$db-> exec("INSERT INTO img SET lien=".$lien.", id_produit=".$id_produit);
					$i++;
				}
				$erreur="Le produit ".$nom_produit." a été publié !";
				require('./views/erreur.phtml');
		}
		else {
			$erreur="Le formulaire est incomplet !";
			require('./views/erreur.phtml');
			}
	}
		require('./views/produit_add.phtml');
}
else {
	$erreur="Vous n'avez pas les droits. ";
		require('./views/erreur.phtml');
	}
?>