<?php

namespace Controllers;

use Message;
use Session;

class Account extends BaseController
{
	protected $modelName = \Models\Account::class;
	
	/**
	 * Render the registration page
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function showRegister(): void
	{
		if (!Session::get('user')) {
			echo $this->twig->render('register.twig');
		} else {
			echo $this->twig->render('home.twig');
		}
	}
	
	/**
	 * Render the connection page
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function showConnection(): void
	{
		if (!Session::get('user')) {
			echo $this->twig->render('connection.twig');
		} else {
			echo $this->twig->render('home.twig');
		}
	}
	
	/**
	 * Ask model to create new user with role "member", and render homepage
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
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
	
	/**
	 * Ask model to connect user, and render homepage
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function connect(): void
	{
		$user = $this->model->connect(filter_input(INPUT_POST, 'password'), filter_input(INPUT_POST, 'username'));
		
		if ($user) {
			echo $this->twig->render('home.twig', ['message' => Message::CONNECTED, 'user' => $user]);
		} else {
			echo $this->twig->render('connection.twig', ['message' => Message::BAD_CREDENTIALS]);
		}
	}
	
	/**
	 * Unset the session and render homepage
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function disconnect(): void
	{
		session_unset();
		echo $this->twig->render('home.twig', ['message' => Message::DISCONNECTED, 'disconnected' => true]);
	}
	
	/**
	 * Render a page with all users to manage them
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function index(): void
	{
		if ($this->role === 'admin') {
			$users = $this->model->findAll();
			echo $this->twig->render('users.twig', compact('users'));
		} else {
			$this->forbidden();
		}
	}
	
	/**
	 * Ask model to promote or demote an user
	 * Require admin role
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function update(): void
	{
		if ($this->role === 'admin') {
			$updated = $this->model->update(filter_input(INPUT_GET, 'id'), filter_input(INPUT_GET, 'work'));
			switch ($updated) {
				case false :
					$this->show404();
					break;
				case 0 :
					echo $this->twig->render('home.twig', ['message' => Message::UNDEFINED_USER]);
					break;
				default :
					echo $this->twig->render('home.twig', ['message' => Message::UPDATED_USER]);
			}
		} else {
			$this->forbidden();
		}
	}
}
