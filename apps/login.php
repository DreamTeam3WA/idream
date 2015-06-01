<?php 
if (isset($_POST['email']) && $_POST['email'] != NULL && isset($_POST['pass']) && $_POST['pass'] != NULL) {
		$email = $db->quote($_POST['email']);
		$pass = $_POST['pass'];

		$tab = $db->query("SELECT * FROM user WHERE email = ".$email)->fetch(PDO::FETCH_ASSOC);

		if (isset($tab['password']) && isset($tab['email']) && isset($tab['id_user']) && isset($tab['droits']) ){
			if (password_verify($pass,$tab['password'])){
				$_SESSION['id'] = $tab['id'];
				$_SESSION['email'] = $tab['email'];
				$_SESSION['droits'] = $tab['droits'];
				header('Location: index.php');
			}
			$commentaire="Erreur login ou mot de passe. ";
			require('views/erreur.phtml');
		}
}
else{
	$commentaire="Erreur informations de connection. ";
	require('views/erreur.phtml');
}


?>