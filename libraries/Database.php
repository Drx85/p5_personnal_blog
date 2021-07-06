<?php

class Database
{
	public static function dbConnect()
	{
		return new PDO('mysql:host=localhost;port=3308;dbname=blog;charset=utf8', 'root', '');
	}
}