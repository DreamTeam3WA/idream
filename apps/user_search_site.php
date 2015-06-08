<?php
if (droits() == 1 || droits() == 2){
		if(isset($_POST['nom']) && !empty($_POST['nom'])){
				$nom = $db->quote("%".$_POST['nom']."%");
				$tab= $db-> query("SELECT * FROM user WHERE nom LIKE ".$nom."COLLATE utf8_unicode_ci  ")->fetchAll(PDO::FETCH_ASSOC);	
					$i=0;
					if (isset($tab[$i])) {
						while (isset($tab[$i])) {
							$id_user = $tab[$i]['id_user'];
							$nom = $tab[$i]['nom'];
							$prenom=$tab[$i]['prenom'];
							$droits=$tab[$i]['droits'];
							require('views/user_search.phtml');
							$i++;
						}
					}
					else {
						$erreur= "Il n'y a pas de résultat à votre recherche";
						require('./views/erreur.phtml');
					}
				}
}
else {
				$erreur= "Vous n'avez pas les droits !";
				require('./views/erreur.phtml');
		}
?>
		