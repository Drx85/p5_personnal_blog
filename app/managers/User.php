<?php

namespace Managers;


class User extends Manager
{
	/**
	 * Create new account with member role
	 *
	 * @param \Entities\User $user
	 *
	 * @return bool
	 */
	public function create(\Entities\User $user): bool
	{
		$password = password_hash($user->getPassword(), PASSWORD_BCRYPT);
		$q = $this->db->prepare('INSERT INTO user (pseudo, password, mail) VALUES (:pseudo, :password, :mail)');
		$q->bindValue(':pseudo', $user->getPseudo());
		$q->bindValue(':password', $password);
		$q->bindValue(':mail', $user->getMail());
		return $q->execute();
	}
	
	/**
	 * Connect an user verifying its username and password
	 *
	 * @param string $password
	 * @param string $pseudo
	 *
	 * @return void|\Entities\User
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
			$user = new \Entities\User();
			$user->setPseudo($pseudo)
				->setRole($q['role']);
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
		$users = $q->fetchAll();
		$arrayUsers = [];
		foreach ($users as $user) {
			$arrayUsers[] = new \Entities\User($user);
		}
		return $arrayUsers;
	}
	
	/**
	 * Promote or demote member or publisher
	 *
	 * @param \Entities\User $user
	 * @param string         $action
	 *
	 * @return false|int
	 */
	public function update(\Entities\User $user, string $action): int
	{
		switch ($action) {
			case 'promote' :
				$user->setRole(2);
				break;
			case 'demote':
				$user->setRole(3);
				break;
			default :
				return false;
		}
		$q = $this->db->prepare('UPDATE user SET id_role = :role WHERE id = :id');
		$q->bindvalue(':role', $user->getRole());
		$q->bindvalue(':id', $user->getId());
		$q->execute();
		return $q->rowCount();
	}
}
