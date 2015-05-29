<?php
function droits()
	{
		if(isset($_SESSION['droits']) && ($_SESSION['droits'] == 1))
		{
			$superAdmin = 1;
			return $superAdmin;
		}
		else if(isset($_SESSION['droits']) && ($_SESSION['droits'] == 2))
		{
			$admin = 2;
			return $admin;
		}
		else if(isset($_SESSION['droits']) && ($_SESSION['droits'] == 3))
		{
			$user = 3;
			return $user;
		}
	}
?>