<?php

use Controllers\Page;
use Doctrine\Inflector\InflectorFactory;

require_once('../vendor/autoload.php');


class Factory
{
	
	
	public static function process(string $controller, string $action, string $token = null)
	{
		try {
			$controllerName = ucfirst($controller);
			
			$inflector = InflectorFactory::create()->build();
			$task      = lcfirst($inflector->classify($action));
			if (AntiCsrf::validate($task, $token) !== true) {
			$controller = new Page();
			$controller->forbidden();
			exit;
			}
			
			$controllerName = '\Controllers\\' . $controllerName;
			$controller     = new $controllerName;
			$controller->$task();
		}
		catch (Error $e) {
			$controller = new Page();
			$controller->show404();
		}
	}
	
	public static function affectGlobal(string $var_name, string $method, $default)
	{
		$type = constant('INPUT_' . $method);
		$global = filter_input($type, $var_name);
		return $global = ($global) ? $global : $default;
	}
}