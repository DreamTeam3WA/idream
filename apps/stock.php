<?php 
$stock = $db->query("SELECT id_stock, id_produit, duree, quantity, virtual_quantity from stock")->fetchAll(PDO::FETCH_ASSOC);

$virtual_quantity = $db->query("SELECT virtual_quantity from stock")->fetchall(PDO::FETCH_ASSOC);
$id_test = $db->query("SELECT id_produit from stock")->fetchall(PDO::FETCH_ASSOC);
$duree_test = $db->query("SELECT duree from stock")->fetchall(PDO::FETCH_ASSOC);






if (isset($_SESSION['panier']) && !empty($_SESSION['panier']))
{
	if(isset($_POST['panier_add'], $_POST['id_produit'], $_POST['duree']) && !empty($_POST['panier_add']) && !empty($_POST['id_produit']) && !empty($_POST['duree']) && $_POST['quantity'] > 0)
	{
		$quantity_tmp= $db->quote($_POST['quantity']);
		$id_produit_tmp= $db->quote($_POST['id_produit']);
		$duree_tmp= $db->quote($_POST['duree']);

		if ($id_produit_tmp == $id_test && $duree_tmp == $duree_test)
		{
			if ($virtual_quantity > $quantity_tmp)
			{
				$db->exec("UPDATE stock SET  virtual_quantity=".$virtual_quantity."-".$quantity_tmp." WHERE id_produit=".$id_produit_tmp." AND duree=".$duree_tmp);
			}
			else
			{
				$erreur="Desolé nous n'avons pas assez de produits en stock";
				require('./views/erreur.phtml')
			}
		}
	}
}


// $i=0;
// while($i<)

 ?>