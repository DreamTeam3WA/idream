<?php
		if(isset($_POST['nom']) && !empty($_POST['nom'])){
				$nom = $db->quote("%".$_POST['nom']."%");
				$tab= $db-> query("SELECT nom_produit, id_produit FROM produit WHERE nom_produit LIKE ".$nom."COLLATE utf8_unicode_ci  ")->fetchAll(PDO::FETCH_ASSOC);	
					$i=0;
					if (isset($tab[$i])) {
						while (isset($tab[$i])) {
							$id_produit = $tab[$i]['id_produit'];
							$resultsearch=$tab[$i]['nom_produit'];
							require('views/produit_search_site_affich.phtml');
							$i++;
						}
					}
					else {
						$erreur= "Il n'y a pas de résultat à votre recherche";
						require('./views/erreur.phtml');
					}
				}


