<?php


class Session
{
	/**
	 * @param string $key
	 * @param string $value
	 *
	 * @return mixed
	 */
	public static function put(string $key, string $value): mixed
	{
		return $_SESSION[$key] = $value;
	}
	
	/**
	 * @param $string key
	 *
	 * @return mixed|null
	 */
	public static function get(string $key): ?mixed
	{
		return (isset($_SESSION[$key]) ? $_SESSION[$key] : null);
	}
	
	/**
	 * @param string $key
	 */
	public static function forget(string $key): void
	{
		unset($_SESSION[$key]);
	}
}