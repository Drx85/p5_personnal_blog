<?php


class AntiCsrf
{
	private static $token = null;
	
	public static function createToken()
	{
		if (self::$token === null) {
			self::$token = uniqid(rand(), true);
			Session::put('token', self::$token);
			Session::put('token_time', time());
		}
		return self::$token;
	}
	
	public static function validateTask($task)
	{
		switch ($task) {
			case "edit":
			case "delete":
			case "validate":
			case "add":
			case "edit":
				return false;
			
			default:
				return true;
		}
	}
	
	public static function validate(string $task, string $token = null)
	{
		if ($token === null) {
			return self::validateTask($task);
		}
		return self::validateToken($token);
	}
	
	public static function validateToken(string $token)
	{
		if (Session::get('token') && Session::get('token_time')) {
			$expired_timestamp = time() - (15 * 60);
			
			if (Session::get('token') == $token && Session::get('token_time') >= $expired_timestamp) {
				return true;
			}
		}
	}
}