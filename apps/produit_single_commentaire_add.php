<?php
if (isset($_POST['action']) && $_POST['action']=="commentaire_add"){ 
	if(isset($_POST['commentaire']) && !empty($_POST['commentaire']) && isset($_SESSION['id']) && !empty($_SESSION['id']) && isset($_POST['note']) && !empty($_POST['note'])){
			$id_user = $db->quote($_SESSION['id']);
			$note = $db->quote($_POST['note']);
			$id_produit = $db->quote($_POST['id_produit']);
			$commentaire = $db->quote($_POST['commentaire']);	
			$db-> exec("INSERT INTO avis SET id_produit=".$id_produit.", id_user=".$id_user.", commentaires=".$commentaire.", note=".$note);
		// require('./views/forum-base.phtml');
	}

	else {
		$erreur="Vous devez être connectés pour poster un avis et tous les champs doivent être remplis!";
		require('./views/erreur.phtml');
		}
}
// else if (droits() == 1 || droits() == 2 || droits() == 3){
// 	require('./views/forum-reponse.phtml');
// }
// else {	
// 	require('views/forum-base.phtml');
// }
?>