<?php

namespace Controllers;
session_start();

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

require_once('../vendor/autoload.php');

abstract class Controller
{
	protected $post;
	protected $pages;
	protected $account;
	protected $comment;
	protected $admin;
	protected $twig;
	
	public function __construct()
	{
		$this->post = new \Models\Post();
		$this->pages = new \Models\Page();
		$this->account = new \Models\Account();
		$this->comment = new \Models\Comment();
		$this->admin = new \Models\Admin();
		
		$loader = new FilesystemLoader('views');
		$this->twig = new Environment($loader, [
			'cache' => false,
			'debug' => true
		]);
		$this->twig->addGlobal('session', $_SESSION);
		$this->twig->addExtension(new DebugExtension());
	}
}