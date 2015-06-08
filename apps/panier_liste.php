<?php 
$prix_total_panier=0;
   $i = 0;
   while (isset($_SESSION['panier'][$i]) && !empty($_SESSION['panier'][$i]['id_produit']) && !empty($_SESSION['panier'][$i]['duree']) && !empty($_SESSION['panier'][$i]['quantity']) ){

      $id_produit = $_SESSION['panier'][$i]['id_produit'];
      $duree = $_SESSION['panier'][$i]['duree'];
      $quantity = $_SESSION['panier'][$i]['quantity'];

     
      $tab = $db->query("SELECT prix, nom_produit, reference FROM produit
         WHERE id_produit =".$id_produit)->fetch(PDO::FETCH_ASSOC);

      $prix = $tab['prix']*$duree/15;
      $prix_total = $prix * $quantity ; 
      $nom_produit = $tab['nom_produit'];
      $reference = $tab['reference'];
      require('./views/panier_liste.phtml');
      $prix_total_panier += $prix_total;
      $i++;
   }
require('./views/panier_footer.phtml');

 ?>