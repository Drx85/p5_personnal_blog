<?php


class Translation
{
	/**
	 * Translate in french asked word
	 *
	 * @param string $value
	 *
	 * @return string
	 */
	public static function translate(string $value): string
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