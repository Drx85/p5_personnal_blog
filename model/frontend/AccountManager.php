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
	
	public function exists($pseudo, $mail)
	{
		$db = $this->dbConnect();
		$q = $db->prepare('SELECT * FROM user WHERE pseudo= ?');
		$q->execute(array($pseudo));
		$pseudoExists = $q->fetch();
		$q = $db->prepare('SELECT * FROM user WHERE mail= ?');
		$q->execute(array($mail));
		$mailExists = $q->fetch();
		
		if($pseudoExists && $mailExists) {
			return 'pseudoMailExists';
		}
		elseif ($pseudoExists) {
			return 'pseudoExists';
		}
		elseif ($mailExists) {
			return 'emailExists';
		}
		else {
			return false;
		}
	}
}