<?php

namespace Controllers;

use Message;
use Session;

class Account extends Controller
{
	protected $modelName = \Models\Account::class;
	
	public function showRegister()
	{
		if (!Session::get('user')) {
			echo $this->twig->render('register.twig');
			exit;
		}
		echo $this->twig->render('home.twig');
	}
	
	public function showConnection()
	{
		if (!Session::get('user')) {
			echo $this->twig->render('connection.twig');
			exit;
		}
		echo $this->twig->render('home.twig');
	}
	
	public function register()
	{
		$user = $this->model->create(filter_input(INPUT_POST, 'pseudo'),
			filter_input(INPUT_POST, 'password'),
			filter_input(INPUT_POST, 'mail'));
		
		if ($user) {
			echo $this->twig->render('register.twig', ['message' => Message::CREATED]);
			exit;
		}
		echo $this->twig->render('register.twig', ['message' => Message::ALREADY_TAKEN]);
	}
	
	public function connect()
	{
		$user = $this->model->connect(filter_input(INPUT_POST, 'password'), filter_input(INPUT_POST, 'username'));
		
		if ($user) {
			echo $this->twig->render('home.twig', ['message' => Message::CONNECTED, 'user' => $user]);
			exit;
		}
		echo $this->twig->render('connection.twig', ['message' => Message::BAD_CREDENTIALS]);
	}
	
	public function disconnect()
	{
		session_destroy();
		echo $this->twig->render('home.twig', ['message' => Message::DISCONNECTED, 'disconnected' => true]);
	}
}