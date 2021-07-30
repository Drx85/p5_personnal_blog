<?php


class AntiCsrf
{
	private static $token = null;
	
	/**
	 * Singleton
	 * If token doesn't exist : create new uniq and unpredictable token, else : keep old token
	 *
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
	 * To know if asked task need a token or not
	 *
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
	 * Validate token but if token doesn't exists : control if asked task is authorized without token
	 *
	 * @param string      $task
	 * @param string|null $token
	 *
	 * @return bool|null
	 */
	public static function validate(string $task, string $token = null): ?bool
	{
		if ($token === null) {
			return self::validateTask($task);
		}
		return self::validateToken($token);
	}
	
	/**
	 * Determine if validate AntiCsrf or not, comparing sent token and existing token and verifying that token is not older than 15 min
	 *
	 * @param string $token
	 *
	 * @return bool|void
	 */
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