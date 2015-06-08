<?php
if (droits() == 1){
	if (isset($_POST['action']) && $_POST['action']=="user_modif_submit"){ 
		if(isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['prenom']) && !empty($_POST['prenom']) && isset($_POST['telephone']) && !empty($_POST['telephone']) && isset($_POST['droits']) && !empty($_POST['droits']) && isset($_POST['id_user']) && !empty($_POST['id_user'])){
					$id_user =$_POST['id_user'];
					$nom = $_POST['nom'];
					$prenom = $_POST['prenom'];
					$email = $_POST['email'];
					$telephone = $_POST['telephone'];
					$droits = $_POST['droits'];
					$db-> exec("UPDATE user SET nom=".$db->quote($nom).", prenom=".$db->quote($prenom).",  email=".$db->quote($email).", telephone=".$db->quote($telephone).", droits=".$db->quote($droits)." WHERE id_user=".$db->quote($id_user));
				
				$erreur="L'user ".$nom." a été modifié !";
				require('./views/erreur.phtml');
		}
	}
	// 	if (isset($_POST['action']) && $_POST['action']=="user_suppr_submit"){ 
	// 	if(isset($_POST['id_user']) && !empty($_POST['id_user'])){
	// 				$id_user =$_POST['id_user'];
	// 				$droits=4;
	// 				$db-> exec("UPDATE user SET droits=".$db->quote($droits)." WHERE id_user=".$db->quote($id_user));
				
	// 			$erreur="Le profil a été archivé !";
	// 			require('./views/erreur.phtml');
	// 	}
	// }
	require('./views/admin_user_modif_affich.phtml');
}
else {
	$erreur="Vous n'avez pas les droits. ";
		require('./views/erreur.phtml');
	}
?>