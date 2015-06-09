<?php 

if (isset($USER)){
   $prix_total_panier=0;
   $id_user = $db->quote($USER->getId());
   $tab = $db->query("SELECT * FROM panier
      JOIN produit ON produit.id_produit = panier.id_produit
      WHERE id_user =".$id_user)->fetchAll(PDO::FETCH_ASSOC);
   $i=0;

   while (isset($tab[$i])) {
      $duree = $tab[$i]['duree_panier'];
      $id_produit = $tab[$i]['id_produit'];
      $quantity = $tab[$i]['quantity'];
      $prix = $tab[$i]['prix']*$duree/15;
      $prix_total = $prix * $quantity ; 
      $nom_produit = $tab[$i]['nom_produit'];
      $reference = $tab[$i]['reference'];

      require('./views/panier_valid_liste.phtml');

      $prix_total_panier += $prix_total;
      $i++;
   }
}
else{
   $erreur = "Vous devez être connectés pour accéder à cette page";
   require('./views/erreur.phtml');
}


 ?>