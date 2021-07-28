<?php

namespace Models;

class Account extends Model
{
	public function create(string $pseudo, string $password, string $mail)
	{
			$password = password_hash($password, PASSWORD_BCRYPT);
			$user = $this->db->prepare('INSERT INTO user (pseudo, password, mail) VALUES (:pseudo, :password, :mail)');
			return $user->execute(compact('pseudo', 'password', 'mail'));
	}
	
	public function connect(string $password, string $pseudo)
	{
		$q = $this->db->prepare('SELECT user.id as user_id, user.password as password, user_role.role as role
									FROM user, user_role
									WHERE user.pseudo = ?
									AND user.id_role = user_role.id');
		$q->execute(array($pseudo));
		$q = $q->fetch();
		
		if (password_verify($password, $q['password'])) {
			$user = new \User($q['user_id'], $pseudo, $q['role']);
			return \Session::put('user', $user);
		}
	}
}
