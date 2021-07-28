<?php


class Session
{
	public static function put($key, $value){
		return $_SESSION[$key] = $value;
	}
	
	public static function get($key){
		return (isset($_SESSION[$key]) ? $_SESSION[$key] : null);
	}
	
	public static function forget($key){
		unset($_SESSION[$key]);
	}
}