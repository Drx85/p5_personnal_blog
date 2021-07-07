<?php

namespace Models;

abstract class Model
{
	protected $db;
	protected $table;
	
	public function __construct()
	{
		$this->db = \Database::dbConnect();
	}
	
	public function find(int $id)
	{
		$q = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
		$q->execute(array($id));
		$item = $q->fetch();
		return $item;
	}
	
	public function delete(int $id)
	{
		$q = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
		$q->execute(array($id));
	}
	
	public function finAllTest(int $id)
	{
		$q = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
		$q->execute(array($id));
		$item = $q->fetch();
		return $item;
	}
}