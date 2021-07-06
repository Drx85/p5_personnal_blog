<?php

class Format
{
	public static function troncate($text, $char_nb, $delim='...')
	{
		$length = $char_nb;
		if($char_nb<strlen($text)){
			while (($text{$length} != " ") && ($length > 0)) {
				$length--;
			}
			if ($length == 0) return substr($text, 0, $char_nb) . $delim;
			else return substr($text, 0, $length) . $delim;
		}else return $text;
	}
}