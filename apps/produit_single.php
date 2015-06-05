<?php
if (isset($_GET['id_produit']) && !empty($_GET['id_produit'])){
	$id_produit = $_GET['id_produit'];
	// $id_produit=$db->quote($id_produit);
	$tab = $db->query("SELECT produit.id_produit, produit.id_category, produit.nom_produit, produit.description, produit.prix, produit.duree, produit.date, produit.reference, avis.id_produit, avis.id_avis, avis.note, avis.commentaires, avis.id_user, avis.date_avis, user.prenom
	FROM produit
	LEFT JOIN avis ON produit.id_produit = avis.id_produit
	LEFT JOIN user ON avis.id_user = user.id_user
	WHERE produit.id_produit=".$id_produit)->fetchAll(PDO::FETCH_ASSOC);
	if (isset($tab) && !empty($tab)) {
		$nom_produit = htmlentities($tab[0]['nom_produit']);
		$reference = htmlentities($tab[0]['reference']);

		$date = $tab[0]['date'];
		$description = htmlentities($tab[0]['description']);
		$duree = $tab[0]['duree'];
		$prix = $tab[0]['prix'];

		require('./views/produit_single.phtml');

		$i=0;
		while(isset($tab[$i])){
			$note = $tab[$i]['note'];
			$commentaires = balise($tab[$i]['commentaires']);
			$date_avis = $tab[$i]['date_avis'];
			$prenom = htmlentities($tab[$i]['prenom']);
			require('./views/produit_commentaire.phtml');
			$i++;
		}
		require('./views/produit_single_end.phtml');
	}

	else {
	$erreur="Produit non trouvé. ";
	require('./views/erreur.phtml');
	die();
	}
}
else {
	$erreur="Produit non trouvé !";
	require('./views/erreur.phtml');
}

// $tableau = array();
$_SESSION['tableau']= array();



// if (isset($_POST['action']) && $_POST['action']=="panier_add")
// {
// 	if (isset($_POST["duree"]) && isset($_POST["quantity"]) && isset($_POST["id_produit"]))
// 	{
// 		if (!empty($_POST["duree"]) && !empty($_POST["quantity"]) && !empty($_POST["id_produit"]))
// 		{	
// 			$duree= $db->quote($_POST["duree"]);
// 			$quantity= $db->quote($_POST["quantity"]);
// 			$id_produit = $db->quote($_POST['id_produit']);
					
// 			$db->exec("INSERT INTO panier SET duree=".$duree.", quantity=".$quantity.", id_produit=".$id_produit);
// 			var_dump($_Session);
// 		}

// 	}
// }
	

			?>
