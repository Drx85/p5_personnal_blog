<?php


class Session
{
	/**
	 * Affect asked value to asked SuperGlobal $_SESSION
	 *
	 * @param string $key
	 * @param $value
	 *
	 */
	public static function put(string $key, $value)
	{
		return $_SESSION[$key] = $value;
	}
	
	/**
	 * Return asked SuperGlobal $_SESSION value
	 *
	 * @param string key
	 *
	 */
	public static function get(string $key)
	{
		return (isset($_SESSION[$key]) ? $_SESSION[$key] : null);
	}
	
	/**
	 * Unset asked SuperGlobal $_SESSION
	 *
	 * @param string $key
	 *
	 * @return void
	 */
	public static function forget(string $key): void
	{
		unset($_SESSION[$key]);
	}
	
	public static function getGlobalSession()
	{
		return $_SESSION;
	}
}