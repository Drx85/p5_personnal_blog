<?php

namespace Controllers;


use Message;
use Session;


require_once '../vendor/autoload.php';

abstract class Controller
{
	protected $model;
	protected $modelName;
	protected $twig;
	protected $role;
	
	/**
	 * Load linked Model, load Twig, get user role
	 */
	public function __construct()
	{
		if ($this->modelName) {
			$this->model = new $this->modelName;
		}
		
		$twig_loader = new  \TwigLoader();
		$this->twig = $twig_loader->getTwig();
		
		if (Session::get('user')) {
			$this->role = Session::get('user')->getRole();
		}
	}
	
	/**
	 * Ask model to delete asked item, and render homepage
	 * Require admin or publisher role
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function delete(): void
	{
		if ($this->hasRoles(['admin', 'publisher'])) {
			$deleted = $this->model->delete((int)filter_input(INPUT_GET, 'id'));
			if ($deleted) {
				echo $this->twig->render('home.twig', ['message' => Message::DELETED_CONTENT]);
			} else {
				echo $this->twig->render('home.twig', ['message' => Message::UNDEFINED_CONTENT]);
			}
		} else {
			$this->forbidden();
		}
	}
	
	/**
	 * Render forbidden page with status 403 Forbidden
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function forbidden(): void
	{
		header('HTTP/1.0 403 Forbidden');
		echo $this->twig->render('forbidden.twig');
	}
	
	/**
	 * Render not found page with status 404 Not Found
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function show404(): void
	{
		header('HTTP/1.0 404 Not Found');
		echo $this->twig->render('404.twig');
	}
	
	/**
	 * To know if an user has the admin or publisher role
	 *
	 * @param array $roles
	 *
	 * @return bool
	 */
	protected function hasRoles($roles): bool
	{
		if (is_array($roles)) {
			foreach ($roles as $role) {
				if ($role === $this->role) return true;
			}
		} elseif ($roles === $this->role) return true;
		return false;
	}
}