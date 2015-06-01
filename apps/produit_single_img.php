<?php

$i=0;

while(!empty($tab[$i]["lien"])){
	$img = $tab[$i]["lien"];
	require('./views/produit_single_img.phtml');
	$i++;
}

?>