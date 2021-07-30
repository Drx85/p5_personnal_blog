<?php

use Controllers\BaseController;
use Controllers\Page;
use Doctrine\Inflector\InflectorFactory;

require_once '../vendor/autoload.php';


class Factory
{
	
	/**
	 * Take Anti Csrf test, then call asked controller and affect it asked action
	 *
	 * @param string      $controller
	 * @param string      $action
	 * @param string|null $token
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 *
	 * @return void
	 */
	public static function process(string $controller, string $action, string $token = null): void
	{
		$controllerName = ucfirst($controller);
		
		$inflector = InflectorFactory::create()->build();
		$task = lcfirst($inflector->classify($action));
		if (AntiCsrf::validate($task, $token) !== true) {
			$controller = new BaseController();
			$controller->forbidden();
			return;
		}
		$controllerName = '\Controllers\\' . $controllerName;
		if (class_exists($controllerName, true)) {
			$controller     = new $controllerName;
			$controller->$task();
		} else {
			$controller = new BaseController();
			$controller->show404();
		}
	}
	
	/**
	 * Create and return new asked SuperGlobal
	 *
	 * @param string      $var_name
	 * @param string      $method
	 * @param string|null $default
	 *
	 * @return string|null
	 */
	public static function affectGlobal(string $var_name, string $method, ?string $default): ?string
	{
		$type = constant('INPUT_' . $method);
		$global = filter_input($type, $var_name);
		return $global = ($global) ? $global : $default;
	}
}