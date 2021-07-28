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
	
	/**
	 * @param int $id
	 *
	 * @return int
	 */
	public function delete(int $id): int
	{
		$q = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
		$q->execute(array($id));
		return $q->rowCount();
	}
}