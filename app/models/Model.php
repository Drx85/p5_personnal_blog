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
	 * Delete asked item in DB
	 *
	 * @param int $id
	 *
	 * @return int
	 */
	public function delete(int $id): int
	{
		if ($this->table === 'comment') {
			$q = $this->db->prepare('UPDATE post as p
											JOIN comment as c ON c.id_post = p.id
											SET p.comments_nb = p.comments_nb - 1
											WHERE c.id = ? AND c.approved = 1');
			$q->execute(array($id));
		}
		$q = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
		$q->execute(array($id));
		return $q->rowCount();
	}
	
	public function findOneBy($criteria, $value)
	{
		$q = $this->db->prepare("SELECT * FROM {$this->table} WHERE :critera = :value");
		$q->execute(compact('criteria', 'value'));
		return $q->fetch();
	}
}