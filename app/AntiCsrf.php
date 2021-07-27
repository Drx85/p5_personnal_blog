<?php


class AntiCsrf
{
	private static $token = null;
	
	public static function createToken()
	{
		if (is_null(self::$token)) {
			self::$token = uniqid(rand(), true);
			$_SESSION['token'] = self::$token;
			$_SESSION['token_time'] = time();
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
		if (isset($_SESSION['token']) && isset($_SESSION['token_time'])) {
			
			$expired_timestamp = time() - (15 * 60);
			
			if ($_SESSION['token'] == $token && $_SESSION['token_time'] >= $expired_timestamp) {
				return true;
			}
		}
	}
}