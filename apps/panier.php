<?php
if (!isset($_SESSION['panier']))
   $_SESSION['panier'] = array();
if (isset($_GET['add'], $_POST['id_produit'], $_POST['duree'], $_POST['quantity']))
{
   $i = 0;
   while (isset($_SESSION['panier'][$i]))
   {
      if ($_SESSION['panier'][$i]['id_produit'] == $_POST['id_produit'] && $_SESSION['panier'][$i]['duree'] == $_POST['duree'] )
      {
         $_SESSION['panier'][$i]['quantite'] += $_POST['quantity'];
      }
      else
         $_SESSION['panier'][] = array("id_produit"=>$_POST['id_produit'], "duree"=>$_POST['duree'], "quantity"=>$_POST['quantity']);
      $i++;
   }
}
if (isset($_GET['delete'], $_POST['id_produit'], $_POST['duree']))
{
   $tmp = array();
   $i = 0;
   while (isset($_SESSION['panier'][$i]))
   {
      if ($_SESSION['panier'][$i]['id_produit'] != $_POST['id_produit'] && $_SESSION['panier'][$i]['duree'] != $_POST['duree'] )
         $tmp[] = $_SESSION['panier'][$i];
      $i++;
   }
   $_SESSION['panier'] = $tmp;
}
if (isset($_GET['edit'], $_POST['id_produit'], $_POST['duree'], $_POST['quantity']))
{
   $i = 0;
   while (isset($_SESSION['panier'][$i]))
   {
      if ($_SESSION['panier'][$i]['id_produit'] == $_POST['id_produit'] && $_SESSION['panier'][$i]['duree'] == $_POST['duree'])
         $_SESSION['panier'][$i]['quantite'] = $_POST['quantity'];
      $i++;
   }
}


// VERROUILLAGE DU PANIER POUR ACTE D'ACHAT
function isVerrouille()
{
   if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
   {
      return true;
   }
   else
   {
      return false;
   }
}

// CALCUL DU MONTANT DU PANIER
// function MontantGlobal(){
//    $total=0;
//    for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
//    {
//       $total += $_SESSION['panier']['quantity'][$i] * $_SESSION['panier']['prix'][$i];
//    }
//    return $total;
// }

// NOMBRE D'ARTICLES DANS PANIER
function compterArticles()
{
   return count($_SESSION['panier']);
}

// SUPPRESSION DU PANIER
function supprimePanier()
{
   $_SESSION['panier'] = array();
}


require('./views/panier.phtml');

?>