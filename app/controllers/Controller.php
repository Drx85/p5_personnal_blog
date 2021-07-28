<?php

namespace Controllers;


use Message;
use Session;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Twig\Extra\String\StringExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

require_once('../vendor/autoload.php');

abstract class Controller
{
	protected $model;
	protected $modelName;
	protected $twig;
	protected $role;
	
	public function __construct()
	{
		$this->model = new $this->modelName;
		
		$loader = new FilesystemLoader('views');
		$this->twig = new Environment($loader, [
			'cache' => false,
			'debug' => true
		]);
		$this->twig->addGlobal('session', $_SESSION);
		$this->twig->addExtension(new DebugExtension());
		$this->twig->addExtension(new StringExtension());
		$this->twig->addFilter(new TwigFilter('trans', function ($value) {
			return \Translation::translate($value);
		}));
		$this->twig->addFunction(new TwigFunction('csrf_token', function () {
			return \AntiCsrf::createToken();
		}));
		
		if (Session::get('user')) {
			$this->role = Session::get('user')->getRole();
		}
	}
	
	protected function hasPermission()
	{
		if ($this->role === 'admin' || $this->role === 'publisher') {
			return true;
		}
	}
	
	protected function forbidden()
	{
		header('HTTP/1.0 403 Forbidden');
		echo $this->twig->render('forbidden.twig');
	}
	
	public function delete()
	{
		if ($this->hasPermission()) {
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
}