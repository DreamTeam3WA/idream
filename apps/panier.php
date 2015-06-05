<?php
// var_dump($_SESSION);
if (!isset($_SESSION['panier']))
   $_SESSION['panier'] = array();


if (isset($_GET['add'], $_POST['id_produit'], $_POST['duree'], $_POST['quantity']))
{
   
   // var_dump($_POST);
   $added = false;
   $i = 0;
   while (isset($_SESSION['panier'][$i]))
   {

      $i++;
   }
   if (!$added){
      $_SESSION['panier'][] = array("id_produit"=>$_POST['id_produit'], "duree"=>$_POST['duree'], "quantity"=>$_POST['quantity']);
   }
   require('apps/panier_liste.php');
}
else if (isset($_GET['delete'], $_GET['id_produit'], $_GET['duree']))
{
   $tmp = array();
   $i = 0;
   while (isset($_SESSION['panier'][$i]))
   {
      if ($_SESSION['panier'][$i]['id_produit'] != $_GET['id_produit'] && $_SESSION['panier'][$i]['duree'] != $_GET['duree'] )
         $tmp[] = $_SESSION['panier'][$i];
      $i++;
   }
   $_SESSION['panier'] = $tmp;
   require('apps/panier_liste.php');

}

else if (isset($_GET['edit'], $_POST['id_produit'], $_POST['duree'], $_POST['quantity']))

{
   $i = 0;
   while (isset($_SESSION['panier'][$i]))
   {
      if ($_SESSION['panier'][$i]['id_produit'] == $_POST['id_produit'] && $_SESSION['panier'][$i]['duree'] == $_POST['duree'])
         $_SESSION['panier'][$i]['quantite'] = $_POST['quantity'];
      $i++;
   }
   require('apps/panier_liste.php');

}
else{
   $erreur = "Erreur du panier";
   require('.views/erreur.phtml');
}
// // VERROUILLAGE DU PANIER POUR ACTE D'ACHAT
// function isVerrouille()
// {
//    if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
//    {
//       return true;
//    }
//    else
//    {
//       return false;
//    }
// }

// // CALCUL DU MONTANT DU PANIER
// // function MontantGlobal(){
// //    $total=0;
// //    for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
// //    {
// //       $total += $_SESSION['panier']['quantity'][$i] * $_SESSION['panier']['prix'][$i];
// //    }
// //    return $total;
// // }

// // NOMBRE D'ARTICLES DANS PANIER
// function compterArticles()
// {
//    return count($_SESSION['panier']);
// }

// // SUPPRESSION DU PANIER
// function supprimePanier()
// {
//    $_SESSION['panier'] = array();
// }


// require('./views/panier.phtml');

?>