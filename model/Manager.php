<?php

abstract class Manager
{
	protected $db;
	
	public function __construct()
	{
		$this->db = $this->dbConnect();
	}
	
    private function dbConnect()
    {
        return new PDO('mysql:host=localhost;port=3308;dbname=blog;charset=utf8', 'root', '');
    }
}