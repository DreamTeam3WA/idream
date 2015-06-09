<?php 
if (isset($_POST['email']) && $_POST['email'] != NULL && isset($_POST['pass']) && $_POST['pass'] != NULL && isset($_POST['action']) && $_POST['action'] == 'connect') {
		$email = $db->quote($_POST['email']);
		$pass = $_POST['pass'];
		$tab = $db->query("SELECT * FROM user WHERE user.email = ".$email)->fetch(PDO::FETCH_ASSOC);
		if (isset($tab['password']) && isset($tab['email']) && isset($tab['id_user']) && isset($tab['droits']) ){
			if (password_verify($pass,$tab['password'])){
				$_SESSION['id_user'] = $tab['id_user'];
				$_SESSION['email'] = $tab['email'];
				$_SESSION['droits'] = $tab['droits'];
				$_SESSION['nom'] = $tab['nom'];
				// require('./apps/header_log.php');
				$id_user = $db->quote($_SESSION['id_user']);
				$panier = $db->query("SELECT * FROM panier
      			WHERE id_user =".$id_user)->fetchall(PDO::FETCH_ASSOC);

      			if (empty($panier[0]['id_panier']) && !empty($_SESSION['panier'][0])){
      				$i=0;
      				while(isset($_SESSION['panier'][$i])){
      					$quantity = $db->quote($_SESSION['panier'][$i]['quantity']);
        				$id_produit = $db->quote($_SESSION['panier'][$i]['id_produit']);
         				$duree = $db->quote($_SESSION['panier'][$i]['duree']);
         				$db-> exec("INSERT INTO panier SET id_user=".$id_user.", id_produit=".$id_produit.", duree_panier=".$duree.", quantity=".$quantity );
         				$i++;
      				}
      			}




			}
			else {
			$erreur="Mot de passe incorrect. ";
			require('views/erreur.phtml');
			}
		}
		else {
			$erreur="Adresse email inexistante. ";
			require('views/erreur.phtml');
			}
}
else{
	$erreur="Erreur informations de connection. ";
	require('views/erreur.phtml');
}


?>