<?php

namespace Controllers;
use Message;

class Account extends Controller
{
	protected $modelName = \Models\Account::class;
	
	public function showRegister()
	{
		if (! isset($_SESSION['user_id'])) {
			echo $this->twig->render('register.twig');
		}
		else {
			echo $this->twig->render('home.twig');
		}
	}
	
	public function showConnection()
	{
		if (! isset($_SESSION['user_id'])) {
			echo $this->twig->render('connection.twig');
		}
		else {
			echo $this->twig->render('home.twig');
		}
	}
	
	public function register()
	{
		$exists = $this->model->exists($_POST['pseudo'], $_POST['mail']);
		if (! $exists) {
			$this->model->create($_POST['pseudo'], $_POST['password'], $_POST['mail']);
			echo $this->twig->render('home.twig', ['message' => Message::CREATED]);
		}
		else {
			echo $this->twig->render('register.twig', ['message' => constant("Message::" . strtoupper($exists))]);
		}
	}
	
	public function connect()
	{
		$this->model->connect($_POST['password'], $_POST['username']);
		
		if (isset($_SESSION['user_id'])) {
			echo $this->twig->render('home.twig', ['message' => Message::CONNECTED]);
		}
		else {
			echo $this->twig->render('connection.twig', ['message' => Message::BAD_CREDENTIALS]);
		}
	}
	
	public function disconnect()
	{
		session_destroy();
		echo $this->twig->render('home.twig', ['message' => Message::DISCONNECTED]);
	}
}