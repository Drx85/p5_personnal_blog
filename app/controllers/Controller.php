<?php

namespace Controllers;


use Message;
use Session;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;


require_once '../vendor/autoload.php';

abstract class Controller
{
	protected $manager;
	protected $managerName;
	protected $twig;
	protected $role;
	
	/**
	 * Load linked Manager, load Twig, get user role
	 */
	public function __construct()
	{
		if ($this->managerName) {
			$this->manager = new $this->managerName;
		}
		
		$twig_loader = new  \TwigLoader();
		$this->twig = $twig_loader->getTwig();
		
		if (Session::get('user')) {
			$this->role = Session::get('user')->getRole();
		}
	}
	
	/**
	 * Ask manager to delete asked item, and render homepage
	 * Require admin or publisher role
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function delete(): void
	{
		if ($this->hasRoles(['admin', 'publisher'])) {
			$deleted = $this->manager->delete((int)filter_input(INPUT_GET, 'id'));
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
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function forbidden(): void
	{
		header('HTTP/1.0 403 Forbidden');
		echo $this->twig->render('forbidden.twig');
	}
	
	/**
	 * Render not found page with status 404 Not Found
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
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