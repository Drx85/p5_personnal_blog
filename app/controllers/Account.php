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
		} else {
			echo $this->twig->render('home.twig');
		}
	}
	
	public function showConnection()
	{
		if (!Session::get('user')) {
			echo $this->twig->render('connection.twig');
		} else {
			echo $this->twig->render('home.twig');
		}
	}
	
	public function register()
	{
		$user = $this->model->create($_POST['pseudo'], $_POST['password'], $_POST['mail']);
		
		if ($user) {
			echo $this->twig->render('register.twig', ['message' => Message::CREATED]);
		} else {
			echo $this->twig->render('register.twig', ['message' => Message::ALREADY_TAKEN]);
		}
	}
	
	public function connect()
	{
		$user = $this->model->connect($_POST['password'], $_POST['username']);
		
		if ($user) {
			echo $this->twig->render('home.twig', ['message' => Message::CONNECTED, 'user' => $user]);
		} else {
			echo $this->twig->render('connection.twig', ['message' => Message::BAD_CREDENTIALS]);
		}
	}
	
	public function disconnect()
	{
		session_unset();
		echo $this->twig->render('home.twig', ['message' => Message::DISCONNECTED, 'disconnected' => true]);
	}
}