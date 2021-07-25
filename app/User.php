<?php


class User
{
	private $id;
	private $pseudo;
	private $role;
	
	public function __construct($id, $pseudo, $role) {
		$this->id = $id;
		$this->pseudo = $pseudo;
		$this->role = $role;
		
		return $this;
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getPseudo() {
		return $this->pseudo;
	}
	
	public function setPseudo($pseudo) {
		return $this->pseudo = $pseudo;
	}
	
	public function getRole() {
		return $this->role;
	}
	
	public function setRole($role) {
		return $this->role = $role;
	}
}