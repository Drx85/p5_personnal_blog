<?php


class Translation
{
	public static function translate($value)
	{
		switch ($value) {
			case "publisher" :
				return "Editeur";
				break;
			
			case "member" :
				return "Membre";
				break;
			
			case "admin" :
				return "Administrateur";
				break;
				
			default:
				return $value;
		}
	}
}