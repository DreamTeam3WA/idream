<?php 
if (!empty($_GET['id_user'])){
	 	$id_user = $_GET['id_user'];
		
		$id_user = $db->quote($id_user);
		$user = $db->query("SELECT * FROM user
		WHERE id_user =".$id_user)->fetchObject('User');


	if ($USER->isAdmin() || $USER->isSuperAdmin() || $USER->getId() == $user->getId() ){
				
		if (isset($_POST) && isset($_POST['action']) && $_POST['action'] == "user_modif"){

			if (isset($_POST['nom']) && $_POST['nom']!= NULL && isset($_POST['prenom']) && $_POST['prenom']!= NULL && isset($_POST['telephone']) && $_POST['telephone']!= NULL && isset($_POST['email']) && $_POST['email']!= NULL ){

				$email = $db->quote($_POST['email']);
				
				

				$tab_email = $db->query("SELECT * from user WHERE email=".$email." AND id_user!=".$id_user);
				
				$caractere_mauvais= array(".","/"," ",":","|", ",");
				
				if($tab_email->rowCount() > 0){ 
						$erreur="L'adresse mail est déjà utilisée !";
						require('views/erreur.phtml');
				} 
			
				//else if ($_POST['password'] === $_POST['password2']) // je verifie que les mdp sont identiques
				else{
			
					$nom = $db->quote($_POST['nom']);
					$prenom = $db->quote($_POST['prenom']);
					$telephone = $db->quote($_POST['telephone']);
					// $email = $db->quote($_POST['um_email']);
					//date_naissance = $db->quote($_POST['date_naissance']);	
					//$password = $db->quote(password_hash($_POST['password'], PASSWORD_BCRYPT,["cost"=>10]));
					$db-> exec("UPDATE user SET nom=".$nom.", prenom=".$prenom.", telephone=".$telephone.", email=".$email." WHERE id_user=".$id_user );
					require('apps/user_single.php');
				}
				//else {
				//	$erreur="Les mots de passe ne sont pas identiques";
				//	require('views/erreur.phtml');
				//}
			}
			else {
				$erreur="Tous les champs ne sont pas remplis";
				require('views/erreur.phtml');
			}
		}
		else{
			require('./views/user_modif.phtml');
		}
	}
	else{
		$erreur = "Vous n'avez pas les droits pour afficher cette page !";
		require('./views/erreur.phtml');
	}
}


?>