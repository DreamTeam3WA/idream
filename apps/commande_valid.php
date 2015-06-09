<?php
if (isset($USER) && isset($_POST['id_adresse']) && !empty($_POST['id_adresse'])){
   $id_user = $db->quote($USER->getId());
   //echo('id_user');
   //var_dump($id_user);
   $id_adresse = $db->quote($_POST['id_adresse']);
   $db-> exec("INSERT INTO facture SET id_user=".$id_user);

   $fac = $db->query("SELECT * FROM facture
   WHERE id_user =".$id_user." ORDER BY id_facture DESC")->fetch(PDO::FETCH_ASSOC);
   $id_facture = $db->quote($fac['id_facture']);

   $tab = $db->query("SELECT * FROM panier
      JOIN produit ON produit.id_produit = panier.id_produit
      WHERE id_user =".$id_user)->fetchAll(PDO::FETCH_ASSOC);
   $i = 0;
   while (isset($tab[$i])) {

   $duree = $db->quote($tab[$i]['duree_panier']);
   $id_produit = $db->quote($tab[$i]['id_produit']);
   $quantity = $db->quote($tab[$i]['quantity']);
   $prix = $tab[$i]['prix']*($tab[$i]['duree_panier']/15);
   $prix_total = $db->quote($prix * $tab[$i]['quantity'] ); 
   $nom_produit = $db->quote($tab[$i]['nom_produit']);
   $reference = $db->quote($tab[$i]['reference']);

   $db-> exec("INSERT INTO commande SET id_user=".$id_user.", id_produit=".$id_produit.", duree_commande=".$duree.", prix_ttc=".$prix_total.", id_facture=".$id_facture.", quantity=".$quantity.", id_adresse=".$id_adresse.", statut=2");

   $i++;
   }
   $db-> exec("DELETE FROM panier WHERE id_user=".$id_user);
   $erreur = "Votre commande a été validée !!";
   require('./views/erreur.phtml');
}
else {
   $erreur = "Erreur dans la commande !!";
   require('./views/erreur.phtml');
}

?>