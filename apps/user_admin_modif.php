<?php
if (droits() == 1 || droits() == 2){
	if (isset($_POST['action']) && $_POST['action']=="user_modif_submit"){ 
		if(isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['prenom']) && !empty($_POST['prenom']) && isset($_POST['telephone']) && !empty($_POST['telephone']) && isset($_POST['droits']) && !empty($_POST['droits']) && isset($_POST['id_user']) && !empty($_POST['id_user'])){
					$id_user =$db->quote($_POST['id_user']);
					$nom = $db->quote($_POST['nom']);
					$prenom = $db->quote($_POST['prenom']);
					$email = $db->quote($_POST['email']);
					$telephone = $db->quote($_POST['telephone']);
					$droits = $db->quote($_POST['droits']);
					$db-> exec("UPDATE user SET nom=".$nom.", email=".$email.", telephone=".$telephone.", droits=".$droits." WHERE id_user=".$id_user);
				
				$erreur="L'user ".$nom." a été modifié !";
				require('./views/erreur.phtml');
				die();
		}
		else {
			$erreur="Le formulaire est incomplet !";
			require('./views/erreur.phtml');
			}
	}
	require('./views/administration.phtml');
}
else {
	$erreur="Vous n'avez pas les droits. ";
		require('./views/erreur.phtml');
	}
?>