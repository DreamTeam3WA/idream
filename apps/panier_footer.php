<?php 
 if (isset($USER)){
   require('./views/panier_footer.phtml');
}
else{
   require('./views/panier_footer_logoff.phtml');
}
?>