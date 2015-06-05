<?php 
if (!empty($_GET['id_user']) && !empty($_GET['id_adresse'])){
	 	$id_user = $_GET['id_user'];
	 	$id_adresse = $_GET['id_adresse'];
		
		$id_user = $db->quote($id_user);
		$user = $db->query("SELECT * FROM user
		WHERE id_user =".$id_user)->fetchObject('User');
		

	if ($USER->isAdmin() || $USER->isSuperAdmin() || $USER->getId() == $user->getId() ){
			
		if (isset($_POST) && isset($_POST['action']) && $_POST['action'] == "user_adresse_modif".$id_adresse){

			if (isset($_POST['nom_adresse']) && $_POST['nom_adresse']!= NULL && isset($_POST['prenom_adresse']) && $_POST['prenom_adresse']!= NULL && isset($_POST['ligne1']) && $_POST['ligne1']!= NULL && isset($_POST['ligne2']) && isset($_POST['ville']) && $_POST['ville']!= NULL && isset($_POST['pays']) && $_POST['pays']!= NULL && isset($_POST['code']) && $_POST['code']!= NULL ){

			
					$nom_adresse = $db->quote($_POST['nom_adresse']);
					$prenom_adresse = $db->quote($_POST['prenom_adresse']);
					$ligne1 = $db->quote($_POST['ligne1']);
					$ligne2 = $db->quote($_POST['ligne2']);
					$ville = $db->quote($_POST['ville']);
					$pays = $db->quote($_POST['pays']);
					$code = $db->quote($_POST['code']);

					$db-> exec("UPDATE adresse SET nom_adresse=".$nom_adresse.", prenom_adresse=".$prenom_adresse.", ligne1=".$ligne1.", ligne2=".$ligne2.", ville=".$ville.", pays=".$pays.", code=".$code." WHERE id_adresse=".$id_adresse );
					require('apps/user_adresse.php');
				}
			else {
				$erreur="Tous les champs ne sont pas remplis";
				require('views/erreur.phtml');
			}
		}
		else{
			$tab = $db->query("SELECT * FROM adresse
 			WHERE id_adresse =".$id_adresse)->fetch(PDO::FETCH_ASSOC);
 			$nom_adresse = htmlentities($tab['nom_adresse']);
			$prenom_adresse = htmlentities($tab['prenom_adresse']);
			$ligne1 = htmlentities($tab['ligne1']);
			$ligne2 = htmlentities($tab['ligne2']);
			$ville = htmlentities($tab['ville']);
			$pays = htmlentities($tab['pays']);
			$code = htmlentities($tab['code']);
			require('./views/user_adresse_modif.phtml');
		}
	}
	else{
			$erreur = "Vous n'avez pas les droits pour afficher cette page !";
			require('./views/erreur.phtml');
	}
}


?>