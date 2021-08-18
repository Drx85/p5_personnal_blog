<?php


namespace Entities;


class User
{
	/**
	 * @var int
	 */
	private $id;
	/**
	 * @var string
	 */
	private $role;
	/**
	 * @var string
	 */
	private $pseudo;
	/**
	 * @var string
	 */
	private $password;
	/**
	 * @var string
	 */
	private $mail;
	
	
	public function hydrate(array $values)
	{
		foreach ($values as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (method_exists($this, $method)) $this->$method($value);
		}
	}
	
	public function __construct($values = [])
	{
		if (!empty($values)) $this->hydrate($values);
	}
	
	/**
	 * @return string
	 */
	public function getRole(): string
	{
		return $this->role;
	}
	
	/**
	 * @param string $role
	 *
	 * @return User
	 */
	public function setRole($role): User
	{
		$this->role = $role;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getPseudo(): string
	{
		return $this->pseudo;
	}
	
	/**
	 * @param string $pseudo
	 *
	 * @return User
	 */
	public function setPseudo($pseudo): User
	{
		$this->pseudo = $pseudo;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getPassword(): string
	{
		return $this->password;
	}
	
	/**
	 * @param string $password
	 *
	 * @return User
	 */
	public function setPassword($password): User
	{
		$this->password = $password;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getMail(): string
	{
		return $this->mail;
	}
	
	/**
	 * @param string $mail
	 *
	 * @return User
	 */
	public function setMail($mail): User
	{
		$this->mail = $mail;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @param int $id
	 *
	 * @return User
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}
	
	
}
