<?php

namespace Controllers;

use Message;
use Session;

class Account extends Controller
{
	protected $modelName = \Models\Account::class;
	
	public function showRegister(): void
	{
		if (!Session::get('user')) {
			echo $this->twig->render('register.twig');
		} else {
			echo $this->twig->render('home.twig');
		}
	}
	
	public function showConnection(): void
	{
		if (!Session::get('user')) {
			echo $this->twig->render('connection.twig');
		} else {
			echo $this->twig->render('home.twig');
		}
	}
	
	public function register(): void
	{
		$user = $this->model->create(filter_input(INPUT_POST, 'pseudo'),
			filter_input(INPUT_POST, 'password'),
			filter_input(INPUT_POST, 'mail'));
		
		if ($user) {
			echo $this->twig->render('register.twig', ['message' => Message::CREATED]);
		} else {
			echo $this->twig->render('register.twig', ['message' => Message::ALREADY_TAKEN]);
		}
	}
	
	public function connect(): void
	{
		$user = $this->model->connect(filter_input(INPUT_POST, 'password'), filter_input(INPUT_POST, 'username'));
		
		if ($user) {
			echo $this->twig->render('home.twig', ['message' => Message::CONNECTED, 'user' => $user]);
		} else {
			echo $this->twig->render('connection.twig', ['message' => Message::BAD_CREDENTIALS]);
		}
	}
	
	public function disconnect(): void
	{
		session_unset();
		echo $this->twig->render('home.twig', ['message' => Message::DISCONNECTED, 'disconnected' => true]);
	}
}