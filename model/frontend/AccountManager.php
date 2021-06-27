<?php

require_once("Manager.php");

class AccountManager extends Manager
{
	public function createAccount()
	{
		$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
		$db = $this->dbConnect();
		$q = $db->prepare('INSERT INTO user (pseudo, password, mail) VALUES (:pseudo, :password, :mail)');
		$q->execute(array(
			'pseudo' => $_POST['pseudo'],
			'password' => $password,
			'mail' => $_POST['mail'],
		));
	}
	
	public function pseudoExists()
	{
		$db = $this->dbConnect();
		$q = $db->prepare('SELECT * FROM user WHERE pseudo= ?');
		$q->execute(array($_POST['pseudo']));
		$exists = $q->fetch();
		if ($exists) {
			return true;
		}
		else {
			return false;
		}
	}
	
	public function emailExists()
	{
		$db = $this->dbConnect();
		$q = $db->prepare('SELECT * FROM user WHERE mail= ?');
		$q->execute(array($_POST['mail']));
		$exists = $q->fetch();
		if ($exists) {
			return true;
		}
		else {
			return false;
		}
	}
}