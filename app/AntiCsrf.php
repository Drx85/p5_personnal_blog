<?php


class AntiCsrf
{
	private static $token = null;
	
	/**
	 * @return string|null
	 */
	public static function createToken(): string
	{
		if (self::$token === null) {
			self::$token = uniqid(rand(), true);
			Session::put('token', self::$token);
			Session::put('token_time', time());
		}
		return self::$token;
	}
	
	/**
	 * @param string $task
	 *
	 * @return bool
	 */
	public static function validateTask(string $task): bool
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
	
	/**
	 * @param string      $task
	 * @param string|null $token
	 *
	 * @return bool
	 */
	public static function validate(string $task, string $token = null): bool
	{
		if ($token === null) {
			return self::validateTask($task);
		}
		return self::validateToken($token);
	}
	
	/**
	 * @param string $token
	 *
	 * @return bool
	 */
	public static function validateToken(string $token): bool
	{
		if (Session::get('token') && Session::get('token_time')) {
			$expired_timestamp = time() - (15 * 60);
			
			if (Session::get('token') == $token && Session::get('token_time') >= $expired_timestamp) {
				return true;
			}
		}
	}
}