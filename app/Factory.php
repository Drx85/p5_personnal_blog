<?php

use Controllers\Page;
use Doctrine\Inflector\InflectorFactory;

require_once '../vendor/autoload.php';


class Factory
{
	/**
	 * @param string      $controller
	 * @param string      $action
	 * @param string|null $token
	 */
	public static function process(string $controller, string $action, string $token = null): void
	{
		$controllerName = ucfirst($controller);
		
		$inflector = InflectorFactory::create()->build();
		$task = lcfirst($inflector->classify($action));
		if (AntiCsrf::validate($task, $token) !== true) {
			$controller = new Page();
			$controller->forbidden();
			return;
		}
		$controllerName = '\Controllers\\' . $controllerName;
		if (class_exists($controllerName, true)) {
			$controller     = new $controllerName;
			$controller->$task();
		} else {
			$controller = new Page();
			$controller->show404();
		}
	}
	
	/**
	 * @param string      $var_name
	 * @param string      $method
	 * @param string|null $default
	 *
	 * @return mixed|string|null
	 */
	public static function affectGlobal(string $var_name, string $method, ?string $default): ?string
	{
		$type = constant('INPUT_' . $method);
		$global = filter_input($type, $var_name);
		return $global = ($global) ? $global : $default;
	}
}