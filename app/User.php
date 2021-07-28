<?php


class User
{
	private $id;
	private $pseudo;
	private $role;
	
	public function __construct(int $id, string $pseudo, string $role) {
		$this->id = $id;
		$this->pseudo = $pseudo;
		$this->role = $role;
		
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
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
	 * @return mixed
	 */
	public function setPseudo(string $pseudo): string
	{
		return $this->pseudo = $pseudo;
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
	 * @return mixed
	 */
	public function setRole(string $role): string
	{
		return $this->role = $role;
	}
}