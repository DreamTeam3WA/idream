<?php 
if (isset($_POST['email']) && $_POST['email'] != NULL && isset($_POST['pass']) && $_POST['pass'] != NULL) {
		$email = $db->quote($_POST['email']);
		$pass = $_POST['pass'];
		$tab = $db->query("SELECT * FROM user WHERE user.email = ".$email)->fetch(PDO::FETCH_ASSOC);
		if (isset($tab['password']) && isset($tab['email']) && isset($tab['id_user']) && isset($tab['droits']) ){
			if (password_verify($pass,$tab['password'])){
				$_SESSION['id_user'] = $tab['id_user'];
				$_SESSION['email'] = $tab['email'];
				$_SESSION['droits'] = $tab['droits'];
				require('./apps/home.php');
				die();
			}
			$erreur="Erreur login ou mot de passe. ";
			require('views/erreur.phtml');
		}
}
else{
	$erreur="Erreur informations de connection. ";
	require('views/erreur.phtml');
}


?>