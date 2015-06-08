<?php 


if (isset($_SESSION['panier']) && !empty($_SESSION['panier']))
{
	// if(isset($_POST['panier_add'], $_POST['id_produit'], $_POST['duree']) && !empty($_POST['panier_add']) && !empty($_POST['id_produit']) && !empty($_POST['duree']) && $_POST['quantity'] > 0)
	// {

		$quantity_tmp= $db->quote($_POST['quantity']);
		$id_produit_tmp= $db->quote($_POST['id_produit']);
		$duree_tmp= $db->quote($_POST['duree']);


		$db->exec("UPDATE stock SET  virtual_quantity=virtual_quantity".$quantity_tmp." WHERE id_produit=".$id_produit_tmp." AND duree=".$duree_tmp);
	}
}



 ?>