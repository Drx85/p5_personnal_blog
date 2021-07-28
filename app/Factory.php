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
			return;
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
}