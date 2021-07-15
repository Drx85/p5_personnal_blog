<?php

namespace Controllers;
session_start();

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Twig\Extra\String\StringExtension;

require_once('../vendor/autoload.php');

abstract class Controller
{
	protected $post;
	protected $pages;
	protected $account;
	protected $comment;
	protected $mail;
	protected $twig;
	protected $role;
	
	public function __construct()
	{
		$this->post = new \Models\Post();
		$this->pages = new \Models\Page();
		$this->account = new \Models\Account();
		$this->comment = new \Models\Comment();
		$this->mail = new \Models\Mail();
		
		$loader = new FilesystemLoader('views');
		$this->twig = new Environment($loader, [
			'cache' => false,
			'debug' => true
		]);
		$this->twig->addGlobal('session', $_SESSION);
		$this->twig->addExtension(new DebugExtension());
		$this->twig->addExtension(new StringExtension());
		
		if (isset($_SESSION['role'])) {
			$this->role = $_SESSION['role'];
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
}