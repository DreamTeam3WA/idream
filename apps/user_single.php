<?php
if (!empty($id_user) && (droits() == 1 || droits() == 2 || $_SESSION['id_user'] == $id_user)) {
// 	if(_SESSION['id_user'] == $id_user){
var_dump($id_user);
	$tab = $db->query("SELECT * FROM user
	JOIN commande ON commande.id_user = user.id_user
	JOIN adresse ON adresse.id_user = user.id_user
	WHERE user.id_user =".$id_user)->fetchAll(PDO::FETCH_ASSOC);
		var_dump($tab);
		die();
		
		$nom = htmlentities($tab['nom']);
		$prenom = htmlentities($tab['prenom']);
		$email = htmlentities($tab['email']);
		$date_naissance = $tab['date_naissance'];
		$telephone = htmlentities($tab['telephone']);
		$prenom_adresse = htmlentities($tab['prenom_adresse']);
		$nom_adresse = htmlentities($tab['nom_adresse']);
		$ligne1 = htmlentities($tab['ligne1']);
		$ligne2 = htmlentities($tab['ligne2']);
		$ville = htmlentities($tab['ville']);
		$code = htmlentities($tab['code']);
		$pays = htmlentities($tab['pays']);
		$date_naissance = $tab['date_naissance'];

	require('apps/user_single.phtml');

}
else {
	$erreur = "Vous n'avez pas les droits pour afficher cette page !"
	require('./views/erreur.phtml');
}
?>