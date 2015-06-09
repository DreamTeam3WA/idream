<?php 
if (!empty($_GET['id_user']) ){
	 	$id_user = $_GET['id_user'];
		$id_user = $db->quote($id_user);
		$user = $db->query("SELECT * FROM user
		WHERE id_user =".$id_user)->fetchObject('User');
		

	if ($USER->isAdmin() || $USER->isSuperAdmin() || $USER->getId() == $user->getId() ){
			
		if (isset($_POST) && isset($_POST['action']) && $_POST['action'] == "user_adresse_add"){

			if (isset($_POST['nom_adresse']) && $_POST['nom_adresse']!= NULL && isset($_POST['prenom_adresse']) && $_POST['prenom_adresse']!= NULL && isset($_POST['ligne1']) && $_POST['ligne1']!= NULL && isset($_POST['ligne2']) && isset($_POST['ville']) && $_POST['ville']!= NULL && isset($_POST['pays']) && $_POST['pays']!= NULL && isset($_POST['code']) && $_POST['code']!= NULL ){

			
					$nom_adresse = $db->quote($_POST['nom_adresse']);
					$prenom_adresse = $db->quote($_POST['prenom_adresse']);
					$ligne1 = $db->quote($_POST['ligne1']);
					$ligne2 = $db->quote($_POST['ligne2']);
					$ville = $db->quote($_POST['ville']);
					$pays = $db->quote($_POST['pays']);
					$code = $db->quote($_POST['code']);
					$id_user = $db->quote($_POST['id_user']);

					$db-> exec("INSERT INTO adresse SET nom_adresse=".$nom_adresse.", prenom_adresse=".$prenom_adresse.", ligne1=".$ligne1.", ligne2=".$ligne2.", ville=".$ville.", pays=".$pays.", code=".$code.", id_user=".$id_user);
					require('apps/user_adresse.php');
				}
			else {
				$erreur="Tous les champs ne sont pas remplis";
				require('views/erreur.phtml');
			}

		}
		else{
			require('views/user_adresse_add.phtml');
		}

	}
	else{
			$erreur = "Vous n'avez pas les droits pour afficher cette page !";
			require('./views/erreur.phtml');
	}
}

?>