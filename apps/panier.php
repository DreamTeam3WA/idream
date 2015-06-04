<?php 


// CREATION DU PANIER
function creationPanier()
{
   if (!isset($_SESSION['panier']))
   {
      $_SESSION['panier']=array();
      $_SESSION['panier']['id_user'] = array();
      $_SESSION['panier']['id_produit'] = array();
      $_SESSION['panier']['duree'] = array();
      $_SESSION['panier']['quantity'] = array();
      $_SESSION['panier']['prix'] = array();
      $_SESSION['panier']['date'] = array();
      $_SESSION['panier']['verrou'] = false;
   }
   return true;
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

// AJOUT D'UN ARTICLE
function ajouterArticle($id_produit,$duree,$quantity)
{

   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //Si le produit existe déjà on ajoute seulement la quantité
      $positionProduit = array_search($id_produit,  $_SESSION['panier']['id_produit']);
      $positionDuree = array_search($duree, $_SESSION['panier']['duree']);

      if ($positionProduit == true && $positionDuree == true)
      {

            $_SESSION['panier']['quantity'][$positionProduit] += $quantity ;
      }
      else
      {
         //Sinon on ajoute le produit
         array_push( $_SESSION['panier']['id_produit'],$id_produit);
         array_push( $_SESSION['panier']['duree'],$duree);
         array_push( $_SESSION['panier']['quantity'],$quantity);
         // array_push( $_SESSION['panier']['prix'],$prix);
         // array_push( $_SESSION['panier']['date'],$date);
      }
   }
   else
   {
      echo "Un problème est survenu veuillez contacter Alex.";
   }
}
// SUPPRESSION D'UN ARTICLE
function supprimerArticle($id_produit)
{
   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //Nous allons passer par un panier temporaire
      $tmp=array();
      $tmp['id_produit'] = array();
      $tmp['duree'] = array();
      $tmp['quantity'] = array();
      $tmp['prix'] = array();
      $tmp['date'] = array();
      $tmp['verrou'] = $_SESSION['panier']['verrou'];

      for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
      {
         if ($_SESSION['panier']['id_produit'][$i] !== $id_produit)
         {
            array_push( $tmp['id_produit'],$_SESSION['panier']['id_produit'][$i]);
            array_push( $tmp['duree'],$_SESSION['panier']['duree'][$i]);
            array_push( $tmp['quantity'],$_SESSION['panier']['quantity'][$i]);
            array_push( $tmp['prix'],$_SESSION['panier']['prix'][$i]);
            array_push( $tmp['date'],$_SESSION['panier']['date'][$i]);
         }

      }
      //On remplace le panier en session par notre panier temporaire à jour
      $_SESSION['panier'] =  $tmp;
      //On efface notre panier temporaire
      unset($tmp);
   }
   else
   {
   echo "Un problème est survenu veuillez contacter Alex.";
   }
}

// MODIFIER UN ARTICLE
function modifierQTeArticle($id_produit,$quantity)
{
   //Si le panier éxiste
   if (creationPanier() && !isVerrouille())
   {
      //Si la quantité est positive on modifie sinon on supprime l'article
      if ($quantity > 0)
      {
         //Recherche du produit dans le panier
         $positionProduit = array_search($id_produit,  $_SESSION['panier']['id_produit']);

         if ($positionProduit !== false)
         {
            $_SESSION['panier']['quantity'][$positionProduit] = $quantity ;
         }
      }
      else
      {
         supprimerArticle($id_roduit);
      }
   }
   else
   {
      echo "Un problème est survenu veuillez contacter Alex.";
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
   if (isset($_SESSION['panier']))
   {
      return count($_SESSION['panier']['libelleProduit']);
   }
   else
   {
      return 0;
   }
}

// SUPPRESSION DU PANIER
function supprimePanier()
{
   unset($_SESSION['panier']);
}


require('./views/panier.phtml');

?>