<?php
if (isset($_GET['id_produit']))
{
	$id_produit=$_GET['id_produit'];
		if (droits() == 1 || droits() == 2)
		{
			$db->exec("DELETE FROM produit WHERE id_produit=".$id_produit);

			$erreur="Le produit a été supprimé";
			require('./views/erreur.phtml');
			die();
		}
		else {
			$erreur = "Vous n'avez pas les droits";
			require('./views/erreur.phtml');
		}
}
else {
	require('./views/home.phtml');
}
?>