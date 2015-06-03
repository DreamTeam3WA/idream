<?php

class User
{
// 1. Enumération des Propriétés
	private $id_user;
	private $nom;
	private $prenom;
	private $date_naissance;
	private $password;
	private $email;
	private $telephone;
	private $droits;

// 2. Enumération des Méthodes

	public function getId()
	{
		return $this->id;
	}
	public function getNom()
	{
		return $this->nom;
	}
	public function getPrenom()
	{
		return $this->prenom;
	}
	public function getBirthday()
	{
		return $this->date_naissance;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function getTelephone()
	{
		return $this->telephone;
	}
	public function isAdmin()
	{
		if($this->droits === 2){
			return true;
		}else{
			return false;
		}
	}
	public function isSuperAdmin()
	{
		if($this->droits === 1){
			return true;
		}else{
			return false;
		}
	}
	public function isUser()
	{
		if($this->droits === 3){
			return true;
		}else{
			return false;
		}
	}
}

?>