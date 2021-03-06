<?php

namespace Controllers;

use Message;
use Session;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Post extends Controller
{
	/**
	 * @var string
	 */
	protected $managerName = \Managers\Post::class;
	
	/**
	 * Ask manager to find all posts by page and to count comments for each, then render posts page with comments number for each post + pages number
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function index(): void
	{
		$pages = new \Managers\Page();
		$posts = $this->manager->findAllbyPage();
		$arrayPages = $pages->get();
		echo $this->twig->render('posts.twig', compact('posts', 'arrayPages'));
	}
	
	/**
	 * Ask manager to find asked post and its approved linked comments and show it in renderer post page
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function show(): void
	{
		$comment = new \Managers\Comment();
		$id = (int)filter_input(INPUT_GET, 'id');
		$post = new \Entities\Post(compact('id'));
		$post = $this->manager->find($post);
		$comments = $comment->findAllByPost(1, (int)filter_input(INPUT_GET, 'id'));
		echo $this->twig->render('post.twig', compact('post', 'comments'));
	}
	
	/**
	 * Ask manager to create new post and render homepage
	 * Require admin or publisher role
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function add(): void
	{
		if ($this->hasRoles(['admin', 'publisher'])) {
			$title = filter_input(INPUT_POST, 'title');
			$message = filter_input(INPUT_POST, 'post_content');
			$post = new \Entities\Post(compact('title', 'message'));
			$post->setDate(date('Y-m-d'))
				->setTime(date('H:i:s'));
			$added = $this->manager->insert($post, Session::get('user')->getPseudo());
			if ($added) {
				echo $this->twig->render('home.twig', ['message' => Message::ADDED]);
			} else {
				echo $this->twig->render('home.twig', ['message' => Message::TITLE_ALREADY_EXISTS]);
			}
		} else {
			$this->forbidden();
		}
	}
	
	/**
	 * Ask manager to edit asked post and render homepage
	 * Require admin or publisher role
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function edit(): void
	{
		if ($this->hasRoles(['admin', 'publisher'])) {
			$id = (int)filter_input(INPUT_GET, 'id');
			$title = filter_input(INPUT_POST, 'title');
			$message = filter_input(INPUT_POST, 'message');
			$author = filter_input(INPUT_POST, 'author');
			$post = new \Entities\Post(compact('id', 'title', 'message', 'author'));
			$edited = $this->manager->edit($post);
			if ($edited) {
				echo $this->twig->render('home.twig', ['message' => Message::EDITED]);
			} else {
				echo $this->twig->render('home.twig', ['message' => Message::TITLE_ALREADY_EXISTS]);
			}
		} else {
			$this->forbidden();
		}
	}
}