<?php
if($_SESSION && isset($_SESSION['email'])){
	$user = $_SESSION['email'];
	if (droits() == 1)
	{
		require('views/header_super_admin.phtml');
	}
	if (droits() == 1 || droits() == 2)
	{
		require('views/header_admin.phtml');
	}
	if (droits() == 1 || droits() == 2 || droits() ==3){
		require('views/header_user.phtml');
	}
}

else {
	require('views/header_log_off.phtml');
}

?>