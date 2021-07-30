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
		if ($this->hasPermission()) {
			$deleted = $this->model->delete((int)filter_input(INPUT_GET, 'id'));
			if ($deleted) {
				echo $this->twig->render('home.twig', ['message' => Message::DELETED_CONTENT]);
			} else {
				echo $this->twig->render('home.twig', ['message' => Message::UNDEFINED_CONTENT]);
			}
		} else {
			$controller = new BaseController();
			$controller->forbidden();
		}
	}
}