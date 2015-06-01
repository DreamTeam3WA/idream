<?php 

if (isset($_POST) && isset($_POST['action']) && $_POST['action'] == "register"){
	// $_POST['login'] => champ input de name login
	// $db->quote(...) => permet de protéger les strings (en rajoutant des quotes avant et apres)
	// ici je créé des variables qui préparent les informations à envoyer dans la future requète...
	if (isset($_POST['nom']) && $_POST['nom']!= NULL && isset($_POST['prenom']) && $_POST['prenom']!= NULL && isset($_POST['telephone']) && $_POST['telephone']!= NULL && isset($_POST['password']) && $_POST['password']!= NULL && isset($_POST['password2']) && $_POST['password2']!= NULL && isset($_POST['email']) && $_POST['email']!= NULL && isset($_POST['date_naissance']) && $_POST['date_naissance']!= NULL ){
		$email = $db->quote($_POST['email']);
		$date_naissance = $_POST['date_naissance'];	

		$tab_email = $db->query("SELECT * from user WHERE email=".$email);
		
		$caractere_mauvais= array(".","/"," ",":","|", ",");
		$date_naissance = str_replace($caractere_mauvais,"-", $date_naissance);
		list($year, $month, $day) = explode("-", $date_naissance);

		if($tab_email->rowCount() > 0){ 
				$erreur="L'adresse mail est déjà utilisée !";
				require('views/erreur.phtml');
		} 
	
		else if (!is_numeric($year) || !is_numeric($month) || !is_numeric($day)) {
			$erreur="Votre date de naissance ne doit comporter que des chiffres et des tirets";
			require('views/erreur.phtml');
		}
		else if (strlen($year)!=4 || strlen($month)!=2 || strlen($day)!=2) {
			$erreur="Respectez la forme aaaa-mm-jj";
			require('views/erreur.phtml');
		}
		else if ($year < 1940)
		{
			$erreur="Ce site n'accepte pas les vampires immortels";
			require('views/erreur.phtml');
		}
		else if ($year > date("Y"))
		{
			$erreur="Ce site n'accepte pas les voyageurs temporels venant du futur";
			require('views/erreur.phtml');
		}
		else if ($year > (date("Y")-4))
		{
			$erreur="Dis donc, t'as quel âge pour savoir écrire dans un formulaire toi ?! Je vais le dire à tes parents !";
			require('views/erreur.phtml');
		}
		else if ($year > (date("Y")-13))
		{
			$erreur="Dis donc, t'as quel âge pour venir sur ce site ! Je vais le dire à tes parents !";
			require('views/erreur.phtml');
		}
		else if ($month < 1 || $month > 12)
		{
			$erreur="Sur cette planète les années n'ont qu'un maximum de 12 mois";
			require('views/erreur.phtml');
		}
		else if ($month==2 && $year%4 == 0 and $year%100 != 0 || $year%400 == 0 && $day <1 || $day > 29)
		{
			$erreur="Sur cette planète pendant une année bissextile, les jours du mois de Février sont compris entre 1 et 29";
			require('views/erreur.phtml');
		}
		else if ($month==2 && $day <1 || $day > 28)
		{
			$erreur="Sur cette planète pendant une année bissextile, les jours du mois de Février sont compris entre 1 et 28";
			require('views/erreur.phtml');
		}
		else if ($month%2==0 && $month!=2 && $day <1 || $day > 30)
		{
			$erreur="Sur cette planète les jours sont compris entre 1 et 30 pour les mois d'Avril, Juin, Septembre, Novembre";
			require('views/erreur.phtml');
		}
		else if ($month%2!=0 && $month!=2 && $day <1 || $day > 31)
		{
			$erreur="Sur cette planète, les jours sont compris entre 1 et 30 pour les mois de Janvier, Mars, Mai, Juillet, Aout, Octobre, Decembre";
			require('views/erreur.phtml');
		}
		else if ($_POST['password'] === $_POST['password2']) // je verifie que les mdp sont identiques
		{
			$nom = $db->quote($_POST['nom']);
			$prenom = $db->quote($_POST['prenom']);
			$telephone = $db->quote($_POST['telephone']);
			$email = $db->quote($_POST['email']);
			$date_naissance = $db->quote($_POST['date_naissance']);	
			$password = $db->quote(password_hash($_POST['password'], PASSWORD_BCRYPT,["cost"=>10]));
			$droits = 3;

			$db-> exec("INSERT INTO user SET nom=".$nom.", prenom=".$prenom.", telephone=".$telephone.", password=".$password.", email=".$email.", date_naissance=".$date_naissance.", droits=".$droits);
			require('views/inscription-ok.phtml');
		}
		else {
			$erreur="Les mots de passe ne sont pas identiques";
			require('views/erreur.phtml');
		}
	}
	else {
		$erreur="Tous les champs ne sont pas remplis";
		require('views/erreur.phtml');
	}
}
require('./views/user_add.phtml'); 

?>