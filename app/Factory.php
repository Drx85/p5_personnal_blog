<?php

use Controllers\BaseController;
use Doctrine\Inflector\InflectorFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

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
	 * @return void
	 * @throws RuntimeError
	 * @throws SyntaxError
	 *
	 * @throws LoaderError
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
			$controller = new $controllerName;
			$controller->$task();
		} else {
			$controller = new BaseController();
			$controller->show404();
		}
	}
	
	/**
	 * Create and return new asked SuperGlobal
	 *
	 * @param string      $varName
	 * @param string      $method
	 * @param string|null $default
	 *
	 * @return string|null
	 */
	public static function affectGlobal(string $varName, string $method, ?string $default): ?string
	{
		$type = constant('INPUT_' . $method);
		$global = filter_input($type, $varName);
		return $global = ($global) ? $global : $default;
	}
}