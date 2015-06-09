<?php 

if (isset($USER)){
  require('./views/panier_valid.phtml');
}
else{
   $erreur = "Vous devez être connectés pour accéder à cette page";
   require('./views/erreur.phtml');
}


 ?>