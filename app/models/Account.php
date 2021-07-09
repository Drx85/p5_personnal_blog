<?php

namespace Models;

class Account extends Model
{
	public function create(string $pseudo, string $password, string $mail)
	{
		$password = password_hash($password, PASSWORD_BCRYPT);
		$q = $this->db->prepare('INSERT INTO user (pseudo, password, mail) VALUES (:pseudo, :password, :mail)');
		$q->execute(compact('pseudo', 'password', 'mail'));
	}
	
	public function exists(string $pseudo, string $mail)
	{
		$q = $this->db->prepare('SELECT * FROM user WHERE pseudo= ?');
		$q->execute(array($pseudo));
		$pseudoExists = $q->fetch();
		$q = $this->db->prepare('SELECT * FROM user WHERE mail= ?');
		$q->execute(array($mail));
		$mailExists = $q->fetch();
		
		if($pseudoExists && $mailExists) {
			return 'pseudo_mail_exists';
		}
		elseif ($pseudoExists) {
			return 'pseudo_exists';
		}
		elseif ($mailExists) {
			return 'mail_exists';
		}
		else {
			return false;
		}
	}
	
	public function connect(string $password, string $pseudo)
	{
		$q = $this->db->prepare('SELECT user.id as user_id, user.password as password, user_role.role as role
									FROM user, user_role
									WHERE user.pseudo= ?
									AND user.id_role = user_role.id');
		$q->execute(array($pseudo));
		$q = $q->fetch();
		
		if (password_verify($password, $q['password']) === true) {
			$_SESSION['user_id'] = $q['user_id'];
			$_SESSION['pseudo'] = $pseudo;
			$_SESSION['role'] = $q['role'];
			}
	}
}
