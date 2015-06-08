<?php
if (droits() == 1 || droits() == 2)
		{
			if (isset($_GET['id_produit']))
			{
				$id_produit=$_GET['id_produit'];
				$id_category=8;
						$db->exec("UPDATE produit SET id_category=".$db->quote($id_category)." WHERE id_produit=".$id_produit);

						$erreur="Le produit a été supprimé";
						require('./views/erreur.phtml');
						die();
					}
			else {
				$erreur="Le produit n'existe pas";
				require('./views/erreur.phtml');
			}
			}

else {
			$erreur = "Vous n'avez pas les droits";
			require('./views/erreur.phtml');
		}
else {
	require('./views/home.phtml');
}
?>