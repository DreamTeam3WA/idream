<?php
$id_user = $db->quote($user->getId());
$tab = $db->query("SELECT * , SUM(prix_ttc) AS prix_total FROM commande
	JOIN user ON commande.id_user = user.id_user
	WHERE user.id_user =".$id_user."
	GROUP BY id_facture")->fetchAll(PDO::FETCH_ASSOC);

$i=0;
	while (isset($tab[$i]['id_commande'])){
		$id_commande = $tab[$i]['id_commande'];
		$id_facture = $tab[$i]['id_facture'];
		$prix_total = $tab[$i]['prix_total'];
		$date_commande = $tab[$i]['date_commande'];
		$statut = $tab[$i]['statut'];
		$i++;
		if($statut == 2){
			$statut = "payée";
		}
		else if ($statut == 1){
			$statut = "expédiée";
		}
		else if ($statut == 3){
			$statut = "en attente du paiement";
		}
		else if ($statut == 4){
			$statut = "annulée";
		}
		else{
			$statut = "erreur";
		}
		require('views/user_commande_liste.phtml');
	}
?>