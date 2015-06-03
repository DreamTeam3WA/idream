<?php

if (!empty($_GET['id_user'])){
 	$id_user = $_GET['id_user'];
	
	$id_user = $db->quote($id_user);
	$user = $db->query("SELECT * FROM user
	WHERE id_user =".$id_user)->fetchObject('User');


	if ($USER->isAdmin() || $USER->isSuperAdmin() || $USER->getId() == $user->getId() ){
		
		$nom = htmlentities($user->getNom());
		$prenom = htmlentities($user->getPrenom());
		$email = htmlentities($user->getEmail());
		$date_naissance = $user->getBirthday();
		$telephone = htmlentities($user->getTelephone());

		require('views/user_single.phtml');

	}
	
else {
	$erreur = "Vous n'avez pas les droits pour afficher cette page !";
	require('./views/erreur.phtml');
}
}
?>