<?php

use Controllers\Page;
use Doctrine\Inflector\InflectorFactory;

require_once('../vendor/autoload.php');


class Factory extends Exception
{
	public static function process($controller, $action)
	{
		try {
			$controllerName = ucfirst($controller);
			
			$inflector = InflectorFactory::create()->build();
			$task      = $inflector->classify($action);
	
			$controllerName = '\Controllers\\' . $controllerName;
			$controller     = new $controllerName;
			$controller->$task();
		}
		catch (Error $e) {
			$controller = new Page();
			$controller->show404();
		}
	}
}