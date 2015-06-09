<?php
if (droits() == 1)
{
	require('./views/administration.phtml');
}
else {
	$erreur= "Vous n'avez pas les droits";
	require('./views/erreur.phtml');
}
?>