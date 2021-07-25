<?php

namespace Controllers;
use Message;

class Account extends Controller
{
	protected $modelName = \Models\Account::class;
	
	public function showRegister()
	{
		if (! isset($_SESSION['user'])) {
			echo $this->twig->render('register.twig');
		}
		else {
			echo $this->twig->render('home.twig');
		}
	}
	
	public function showConnection()
	{
		if (! isset($_SESSION['user'])) {
			echo $this->twig->render('connection.twig');
		}
		else {
			echo $this->twig->render('home.twig');
		}
	}
	
	public function register()
	{
		$user = $this->model->create($_POST['pseudo'], $_POST['password'], $_POST['mail']);

		if ($user) {
			echo $this->twig->render('home.twig', ['message' => Message::CREATED]);
		} else {
			echo $this->twig->render('home.twig', ['message' => Message::ALREADY_TAKEN]);
		}
	}
	
	public function connect()
	{
		$user = $this->model->connect($_POST['password'], $_POST['username']);
		
		if ($user) {
			echo $this->twig->render('home.twig', ['message' => Message::CONNECTED, 'user' => $user]);
		}
		else {
			echo $this->twig->render('connection.twig', ['message' => Message::BAD_CREDENTIALS]);
		}
	}
	
	public function disconnect()
	{
		session_destroy();
		echo $this->twig->render('home.twig', ['message' => Message::DISCONNECTED, 'disconnected' => true]);
	}
}