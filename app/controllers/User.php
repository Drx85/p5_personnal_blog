<?php

namespace Controllers;

use Message;
use Session;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class User extends Controller
{
	protected $managerName = \Managers\User::class;
	
	/**
	 * Render the registration page
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
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
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
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
	 * Ask manager to create new user with role "member", and render homepage
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function register(): void
	{
		$pseudo = filter_input(INPUT_POST, 'pseudo');
		$password = filter_input(INPUT_POST, 'password');
		$mail = filter_input(INPUT_POST, 'mail');
		$user = new \Entities\User(compact('pseudo', 'password', 'mail'));
		$success = $this->manager->create($user);
		if ($success === true) {
			echo $this->twig->render('register.twig', ['message' => Message::CREATED]);
		} else {
			echo $this->twig->render('register.twig', ['message' => Message::ALREADY_TAKEN]);
		}
	}
	
	/**
	 * Ask manager to connect user, and render homepage
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function connect(): void
	{
		$pseudo = filter_input(INPUT_POST, 'username');
		$password = filter_input(INPUT_POST, 'password');
		$user = $this->manager->connect($password, $pseudo);
		if ($user) {
			echo $this->twig->render('home.twig', ['message' => Message::CONNECTED, 'user' => $user]);
		} else {
			echo $this->twig->render('connection.twig', ['message' => Message::BAD_CREDENTIALS]);
		}
	}
	
	/**
	 * Unset the session and render homepage
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function disconnect(): void
	{
		session_unset();
		echo $this->twig->render('home.twig', ['message' => Message::DISCONNECTED, 'disconnected' => true]);
	}
	
	/**
	 * Render a page with all users to manage them
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function index(): void
	{
		if ($this->hasRoles('admin')) {
			$users = $this->manager->findAll();
			echo $this->twig->render('users.twig', compact('users'));
		} else {
			$this->forbidden();
		}
	}
	
	/**
	 * Ask manager to promote or demote an user
	 * Require admin role
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function update(): void
	{
		if ($this->hasRoles('admin')) {
			$id = (int)filter_input(INPUT_GET, 'id');
			$action = filter_input(INPUT_GET, 'work');
			$user = new \Entities\User(compact('id'));
			$updated = $this->manager->update($user, $action);
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
