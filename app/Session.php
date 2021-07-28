<?php


class Session
{
	/**
	 * @param string $key
	 * @param $value
	 *
	 * @return
	 */
	public static function put(string $key, $value)
	{
		return $_SESSION[$key] = $value;
	}
	
	/**
	 * @param $string key
	 *
	 * @return
	 */
	public static function get(string $key)
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