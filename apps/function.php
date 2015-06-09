<?php
function droits()
	{
		if(isset($_SESSION['droits']) && ($_SESSION['droits'] == 1))
		{
			$superAdmin = 1;
			return $superAdmin;
		}
		else if(isset($_SESSION['droits']) && ($_SESSION['droits'] == 2))
		{
			$admin = 2;
			return $admin;
		}
		else if(isset($_SESSION['droits']) && ($_SESSION['droits'] == 3))
		{
			$user = 3;
			return $user;
		}
	}
	function balise($text){
		$html5 = "<source><embed><img><br><span><u><b><i><code><abbr><q><cite><s><small><strong><em><a><div><figcaption><figure><li><ul><ol><blockquote><pre><hr><p><address><link>";

        $text = strip_tags($text,$html5);
        return $text;
    
	}
function verifstock($id_produit, $duree)
{
	$db = new PDO("mysql:dbname=dreamcommerce;host=10.32.195.200", 'idream', 'troiswa');
	$db->exec("SET CHARACTER SET utf8");
	$verif = $db->query("SELECT * FROM stock WHERE id_produit=".$id_produit." AND duree=".$duree)->fetch(PDO::FETCH_ASSOC);
	$stock= $verif['virtual_quantity'];
	if ($stock>0) {
		return true;
	}
	else {
		return false;
	}
}

?>