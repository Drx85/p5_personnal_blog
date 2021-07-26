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
	
	public function delete(int $id)
	{
		$q = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
		$q->execute(array($id));
		return $q->rowCount();
	}
}