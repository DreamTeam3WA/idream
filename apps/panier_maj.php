<?php
// if (isset($_GET['id_produit'])){
// 	$id_produit = $_GET['id_produit'];
// 	// $id_produit=$db->quote($id_produit);
// 	$tab = $db->query("SELECT produit.*, panier.quantity
// 	FROM produit
// 	JOIN panier ON produit.id_produit=panier.id_produit
// 	WHERE produit.id_produit=".$id_produit )->fetchAll(PDO::FETCH_ASSOC);
// 	if (isset($tab) && !empty($tab)) {

// 		$quantity = 1;
// 		$nom_produit = htmlentities($tab[0]['nom_produit']);
// 		$reference = htmlentities($tab[0]['reference']);
// 		$duree = $tab[0]['duree'];
// 		$prix = $tab[0]['prix'];
// 		require('./views/panier_maj.phtml');
// 	}

// 	else {
// 	$erreur="Produit non trouvé. ";
// 	require('./views/erreur.phtml');
// 	die();
// 	}
// }
// else {
// 	$erreur="Vous n'avez pas le droit d'accéder directement sans passer par la page d'accueil en haut à gauche, angle 180° à droite de là bas, en haut enfin tu vois ce que je veux dire non ?";
// 	require('./views/erreur.phtml');
// }


$erreur = false;

// $action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
// if($action !== null)
// {
//    if(!in_array($action,array('ajout', 'suppression', 'refresh')))
//    $erreur=true;

creationPanier();

isVerrouille();

if (isset($_POST['action']) && $_POST['action']=="panier_add")
{
   if (isset($_POST["duree"]) && isset($_POST["quantity"]) && isset($_POST["id_produit"]))
   {
      if (!empty($_POST["duree"]) && !empty($_POST["quantity"]) && !empty($_POST["id_produit"]))
      {

      //récuperation des variables en POST ou GET
         $id_produit = $_POST["id_produit"];
         $duree = $_POST["duree"];
         $quantity = $_POST["quantity"];

         ajouterArticle($id_produit,$duree,$quantity);
      }   
   }
}


// var_dump($_SESSION['panier']);



   //Suppression des espaces verticaux
   // $id_produit = preg_replace('#\v#', '',$id_produit);
   //On verifie que $p soit un float
   // $prix = floatval($prix);

   //On traite $q qui peut etre un entier simple ou un tableau d'entier
    




// if (is_array($panier_quantity))
// {
//    $quantity = array();
//    $i=0;
//    foreach ($panier_quantity as $contenu)
//    {
//       $quantity[$i++] = intval($contenu);
//    }
// }
// else
// {
//    $panier_quantity = intval($panier_quantity);
// }

// if (!$erreur){
//    switch($action){
//       Case "ajout":
//          ajouterArticle($panier_produit,$panier_quantity,$panier_prix,$panier_duree);
//          break;

//       Case "suppression":
//          supprimerArticle($l);
//          break;

//       Case "refresh" :
//          for ($i = 0 ; $i < count($panier_produit) ; $i++)
//          {
//             modifierQTeArticle($_SESSION['panier']['id_produit'][$i],round($QteArticle[$i]));
//          }
//          break;

//       Default:
//          break;
//    }
// }
require('./views/panier_maj.phtml');


?>
