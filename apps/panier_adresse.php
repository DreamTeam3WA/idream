<?php 
$tab = $db->query("SELECT * FROM adresse
 	WHERE id_user =".$id_user)->fetchAll(PDO::FETCH_ASSOC);
	$i=0;
	
	while (isset($tab[$i])){
			$prenom_adresse = htmlentities($tab[$i]['prenom_adresse']);
			$id_adresse = $tab[$i]["id_adresse"];
			$id_user = $tab[$i]["id_user"];
			$nom_adresse = htmlentities($tab[$i]['nom_adresse']);
			$ligne1 = htmlentities($tab[$i]['ligne1']);
			$ligne2 = htmlentities($tab[$i]['ligne2']);
			$ville = htmlentities($tab[$i]['ville']);
			$code = htmlentities($tab[$i]['code']);
			$pays = htmlentities($tab[$i]['pays']);
			$i++;
			require('views/panier_adresse.phtml');
		}





?>