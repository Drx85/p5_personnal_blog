<?php

namespace Controllers;


use Message;
use Session;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Twig\Extra\String\StringExtension;
use Twig\Extra\Markdown\MarkdownExtension;
use Twig\Extra\Markdown\DefaultMarkdown;
use Twig\Extra\Markdown\MarkdownRuntime;
use Twig\RuntimeLoader\RuntimeLoaderInterface;
use Twig\TwigFilter;
use Twig\TwigFunction;

require_once '../vendor/autoload.php';

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
		$this->twig->addExtension(new MarkdownExtension());
		$this->twig->addFilter(new TwigFilter('trans', function ($value) {
			return \Translation::translate($value);
		}));
		$this->twig->addFunction(new TwigFunction('csrf_token', function () {
			return \AntiCsrf::createToken();
		}));
		
		$this->twig->addRuntimeLoader(new class implements RuntimeLoaderInterface {
			public function load($class)
			{
				if (MarkdownRuntime::class === $class) {
					return new MarkdownRuntime(new DefaultMarkdown());
				}
			}
		});
		
		if (Session::get('user')) {
			$this->role = Session::get('user')->getRole();
		}
	}
	
	/**
	 * @return bool|null
	 */
	protected function hasPermission(): ?bool
	{
		if ($this->role === 'admin' || $this->role === 'publisher') {
			return true;
		}
	}
	
	protected function forbidden(): void
	{
		header('HTTP/1.0 403 Forbidden');
		echo $this->twig->render('forbidden.twig');
	}
	
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
			$this->forbidden();
		}
	}
}