<?php
if (isset($USER)){
   $id_user = $db->quote($USER->getId());
   
   $tab = $db->query("SELECT panier.*, stock.* FROM panier 
   RIGHT JOIN stock ON panier.id_produit = stock.id_produit AND panier.duree_panier = stock.duree
   WHERE id_user =".$id_user)->fetchAll(PDO::FETCH_ASSOC);
   if (isset($_GET['add'], $_POST['id_produit'], $_POST['duree'], $_POST['quantity']))
   {
      $added = false;
      $i = 0;
      while (isset($tab[$i])){
         // var_dump($tab[$i]);
         if ($tab[$i]['id_produit'] == $_POST['id_produit'] && $tab[$i]['duree_panier'] == $_POST['duree'] ){
            $tab[$i]['quantity'] += $_POST['quantity'];
            $id_produit= $db->quote($_POST['id_produit']);
            $duree= $db->quote($_POST['duree']);
            $quantity = $db->quote($tab[$i]['quantity']);
            $id_panier = $db->quote($tab[$i]['id_panier']);
            $added = true;
            // if ($tab[$i]['virtual_quantity']>$tab[$i]['quantity']) {
                           
            $db-> exec("UPDATE panier SET quantity=".$quantity." WHERE id_panier=".$id_panier );

            $quantity_actualiser = $tab[$i]['virtual_quantity']-$_POST['quantity'];
            if(verifstock($id_produit, $duree)== true)
            {
            $db-> exec("UPDATE stock SET virtual_quantity=".($db->quote($quantity_actualiser))." WHERE id_produit=".$id_produit." AND duree=".$duree);
               }
            // }
         }
         $i++;
      }
      if (!$added){
         $quantity = $db->quote($_POST['quantity']);
         $id_produit = $db->quote($_POST['id_produit']);
         $duree = $db->quote($_POST['duree']);
         $db-> exec("INSERT INTO panier SET id_user=".$id_user.", id_produit=".$id_produit.", duree_panier=".$duree.", quantity=".$quantity );

         $tab2 = $db->query("SELECT virtual_quantity FROM stock 
         WHERE id_produit =".$id_produit." AND duree=".$duree)->fetch(PDO::FETCH_ASSOC);
         $quantity_actualiser = $tab2['virtual_quantity']-$_POST['quantity'];
          if(verifstock($id_produit, $duree)== true)
            {
            $db-> exec("UPDATE stock SET virtual_quantity=".($db->quote($quantity_actualiser))." WHERE id_produit=".$id_produit." AND duree=".$duree);
            }
      }
      require('apps/panier_liste.php');
   }
   else if (isset($_GET['delete'], $_GET['id_produit'], $_GET['duree']))
   {
      $id_produit = $db->quote($_GET['id_produit']);
      $duree = $db->quote($_GET['duree']);
      $quantity = $db->quote($_GET['quantity']);

      $db-> exec("DELETE FROM panier WHERE duree_panier=".$duree." AND id_produit=".$id_produit." AND id_user=".$id_user );


      $tab2 = $db->query("SELECT virtual_quantity FROM stock 
         WHERE id_produit =".$id_produit." AND duree=".$duree)->fetch(PDO::FETCH_ASSOC);
      $quantity_actualiser = $tab2['virtual_quantity']+$_GET['quantity'];
      if(verifstock($id_produit, $duree)== true)
            {
      $db-> exec("UPDATE stock SET virtual_quantity=".($db->quote($quantity_actualiser))." WHERE id_produit=".$id_produit." AND duree=".$duree);
      }

      require('apps/panier_liste.php');

   }
   else if (isset($_GET['edit'], $_POST['id_produit'], $_POST['duree'], $_POST['quantity'])){
      
      $i = 0;
      while (isset($tab[$i]))
      {
         if ($tab[$i]['id_produit'] == $_POST['id_produit'] && $tab[$i]['duree_panier'] == $_POST['duree'] && $_POST['quantity'] > 0){
            $duree = $db->quote($_POST['duree']);
            $id_produit = $db->quote($_POST['id_produit']);
            $panier = $db->query("SELECT SUM(quantity) FROM panier
            WHERE id_produit =".$id_produit." AND duree_panier=".$duree." AND id_user=".$id_user)->fetch(PDO::FETCH_ASSOC);
            $quantity_old = $panier['SUM(quantity)'];

            $quantity = $_POST['quantity'];
            $id_panier = $db->quote($tab[$i]['id_panier']);
            $db-> exec("UPDATE panier SET quantity=".($db->quote($quantity))." WHERE id_panier=".$id_panier );


            $tab2 = $db->query("SELECT virtual_quantity FROM stock WHERE id_produit =".$id_produit." AND duree=".$duree)->fetch(PDO::FETCH_ASSOC);
            $quantity_result = $quantity_old - $quantity;
            $quantity_actualiser = $tab2['virtual_quantity']+ $quantity_result;
            if(verifstock($id_produit, $duree)== true)
            {
            $db-> exec("UPDATE stock SET virtual_quantity=".($db->quote($quantity_actualiser))." WHERE id_produit=".$id_produit." AND duree=".$duree);
            }


         }
         $i++;
      }
      require('apps/panier_liste.php');
   }
   else if (isset($_GET['valid'])){
      require('apps/panier_valid.php');
   }
   else{
      require('views/panier.phtml');
   }
} 
else{ // SI UTILISATEUR NON ENREGISTRE
   if (!isset($_SESSION['panier']))
      $_SESSION['panier'] = array();

   $tab = $db->query("SELECT * FROM stock")->fetchAll(PDO::FETCH_ASSOC);


   if (isset($_GET['add'], $_POST['id_produit'], $_POST['duree'], $_POST['quantity']))
   {
      // var_dump($_POST);
      $added = false;
      $i = 0;
      while (isset($_SESSION['panier'][$i]))
      {
         
         if ($_SESSION['panier'][$i]['id_produit'] == $_POST['id_produit'] && $_SESSION['panier'][$i]['duree'] == $_POST['duree'] ){
            $_SESSION['panier'][$i]['quantity'] += $_POST['quantity'];
            $added = true;

            $db-> exec("UPDATE panier SET quantity=".$quantity." WHERE id_panier=".$id_panier );

            $quantity_actualiser = $tab[$i]['virtual_quantity']-$_POST['quantity'];
            if(verifstock($id_produit, $duree)== true)
            {
            $db-> exec("UPDATE stock SET virtual_quantity=".($db->quote($quantity_actualiser))." WHERE id_produit=".$id_produit." AND duree=".$duree);
            }
            else {
               $erreur="Il n'y a plus de stock disponible";
               require('./views/erreur.phtml');
            }
         }
         $i++;
      }
      if (!$added){
         $_SESSION['panier'][] = array("id_produit"=>$_POST['id_produit'], "duree"=>$_POST['duree'], "quantity"=>$_POST['quantity']);
      }
      require('apps/panier_liste.php');
   }
   else if (isset($_GET['delete'], $_GET['id_produit'], $_GET['duree']))
   {
      //var_dump($_SESSION['panier']);
      $tmp = array();
      $i = 0;
      while (isset($_SESSION['panier'][$i]))
      {
         if ($_SESSION['panier'][$i]['id_produit'] != $_GET['id_produit'] || $_SESSION['panier'][$i]['duree'] != $_GET['duree'] )
            $tmp[] = $_SESSION['panier'][$i];
         $i++;
      }
      $_SESSION['panier'] = $tmp;
      //var_dump($_SESSION['panier']);
      require('apps/panier_liste.php');

   }

   else if (isset($_GET['edit'], $_POST['id_produit'], $_POST['duree'], $_POST['quantity'])){
      
      $i = 0;
      while (isset($_SESSION['panier'][$i]))
      {
         if ($_SESSION['panier'][$i]['id_produit'] == $_POST['id_produit'] && $_SESSION['panier'][$i]['duree'] == $_POST['duree'] && $_POST['quantity'] > 0){
            $_SESSION['panier'][$i]['quantity'] = $_POST['quantity'];
         }
         $i++;
      }
      require('apps/panier_liste.php');
   }
   else if (isset($_GET['valid'])){
      require('apps/panier_valid.php');
   }
   else{
      require('views/panier.phtml');
   }
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