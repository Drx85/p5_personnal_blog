<?php

namespace Models;

class Account extends Model
{
	/**
	 * @param string $pseudo
	 * @param string $password
	 * @param string $mail
	 *
	 * @return bool
	 */
	public function create(string $pseudo, string $password, string $mail): bool
	{
			$password = password_hash($password, PASSWORD_BCRYPT);
			$user = $this->db->prepare('INSERT INTO user (pseudo, password, mail) VALUES (:pseudo, :password, :mail)');
			return $user->execute(compact('pseudo', 'password', 'mail'));
	}
	
	/**
	 * @param string $password
	 * @param string $pseudo
	 *
	 * @return \User
	 */
	public function connect(string $password, string $pseudo): \User
	{
		$q = $this->db->prepare('SELECT user.id as user_id, user.password as password, user_role.role as role
									FROM user, user_role
									WHERE user.pseudo = ?
									AND user.id_role = user_role.id');
		$q->execute(array($pseudo));
		$q = $q->fetch();
		
		if (password_verify($password, $q['password'])) {
			$user = new \User($q['user_id'], $pseudo, $q['role']);
			\Session::put('user', $user);
			return $user;
		}
	}
}
