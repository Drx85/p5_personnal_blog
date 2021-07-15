<?php


class Database
{
	public static function dbConnect()
	{
		return new PDO("mysql:host=" . \Config::DB_HOST . ";
		port=" . \Config::DB_PORT . ";dbname=blog;
		charset=utf8", \Config::DB_USERNAME, Config::DB_PASSWORD);
	}
}