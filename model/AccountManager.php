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
	
	public function userConnect($password, $pseudo)
	{
		$db = $this->dbConnect();
		$q = $db->prepare('SELECT user.id as user_id, user.password as password, user_role.role as role
									FROM user, user_role
									WHERE user.pseudo= ?
									AND user.id_role = user_role.id');
		$q->execute(array($pseudo));
		$q = $q->fetch();
		
		if (password_verify($password, $q['password']) === true) {
			$_SESSION['user_id'] = $q['user_id'];
			$_SESSION['pseudo'] = $pseudo;
			$_SESSION['role'] = $q['role'];
			return true;
		}
	}
}