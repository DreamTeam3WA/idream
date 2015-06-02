<?php 


// CREATION DU PANIER
function creationPanier(){
   if (!isset($_SESSION['panier'])){
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

// AJOUT D'UN ARTICLE
function ajouterArticle($id_produit,$duree,$quantity,$prix,$date){

   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //Si le produit existe déjà on ajoute seulement la quantité
      $positionProduit = array_search($id_produit,  $_SESSION['panier']['id_produit']);

      if ($positionProduit !== false)
      {
         $_SESSION['panier']['quantity'][$positionProduit] += $quantity ;
      }
      else
      {
         //Sinon on ajoute le produit
         array_push( $_SESSION['panier']['id_produit'],$id_produit);
         array_push( $_SESSION['panier']['duree'],$duree);
         array_push( $_SESSION['panier']['quantity'],$quantity);
         array_push( $_SESSION['panier']['prix'],$prix);
         array_push( $_SESSION['panier']['date'],$date);
      }
   }
   else
   echo "Un problème est survenu veuillez contacter Alex.";
}

// SUPPRESSION D'UN ARTICLE
function supprimerArticle($id_produit){
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
   echo "Un problème est survenu veuillez contacter Alex.";
}

require('./views/panier.phtml');

?>