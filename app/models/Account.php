<?php

namespace Models;

use Controllers\BaseController;

class Account extends Model
{
	/**
	 * Create new account with member role
	 *
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
	 * Connect an user verifying its username and password
	 *
	 * @param string $password
	 * @param string $pseudo
	 *
	 * @return void|\User
	 */
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
			\Session::put('user', $user);
			return $user;
		}
	}
	
	/**
	 * Return all users and their roles
	 *
	 * @return array
	 */
	public function findAll(): array
	{
		$q = $this->db->query("SELECT user.id as id, user.pseudo as pseudo, user.mail as mail, user_role.role as role
									FROM user, user_role
									WHERE (role = 'member' OR role = 'publisher')
									AND user.id_role = user_role.id
									ORDER BY role DESC");
		return $q->fetchAll();
	}
	
	/**
	 * Promote or demote member or publisher
	 *
	 * @param int    $id
	 * @param string $action
	 *
	 * @return false|int
	 */
	public function update(int $id, string $action)
	{
		switch ($action) {
			case 'promote' :
				$role = 2;
				break;
			case 'demote':
				$role = 3;
				break;
			default :
				return false;
		}
		$q = $this->db->prepare('UPDATE user SET id_role = ? WHERE id = ?');
		$q->execute(array($role, $id));
		return $q->rowCount();
	}
}
