<?php
if (droits() == 1 || droits() == 2){
	if (isset($_POST['action']) && $_POST['action']=="addproduit"){ 
		if(isset($_POST['titre']) && !empty($_POST['titre']) && isset($_POST['description']) && !empty($_POST['description'])){
				$titre = $db->quote($_POST['titre']);
				$description = $db->quote($_POST['description']);	
				$lien = $db->quote($_POST['lien']);
				$db-> exec("INSERT INTO produit SET titre=".$titre.", lien=".$lien.", user=".$user.", description=".$description);
		}
		else {
			$erreur="Il n'y a pas de titre ou de description !";
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