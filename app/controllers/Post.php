<?php

namespace Controllers;

use Message;
use Session;

class Post extends Controller
{
	/**
	 * @var string
	 */
	protected $modelName = \Models\Post::class;
	
	/**
	 * Ask model to find all posts by page and to count comments for each, then render posts page with comments number for each post + pages number
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function index(): void
	{
		$pages = new \Models\Page();
		$comment = new \Models\Comment();
		
		$posts = $this->model->findAllbyPage();
		$array_pages = $pages->get();
		$comments_number = $comment->count();
		echo $this->twig->render('posts.twig', compact('posts', 'comments_number', 'array_pages'));
	}
	
	/**
	 * Ask model to find asked post and its approved linked comments and show it in renderer post page
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function show(): void
	{
		$comment = new \Models\Comment();
		$post = $this->model->find((int)filter_input(INPUT_GET, 'id'));
		$comments = $comment->findAllByPost(1, (int)filter_input(INPUT_GET, 'id'));
		echo $this->twig->render('post.twig', compact('post', 'comments'));
	}
	
	/**
	 * Ask model to create new post and render homepage
	 * Require admin or publisher role
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function add(): void
	{
		if ($this->hasRoles(['admin', 'publisher'])) {
			$added = $this->model->insert(filter_input(INPUT_POST, 'title'), filter_input(INPUT_POST, 'post_content'), Session::get('user')->getPseudo());
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
	 * Ask model to edit asked post and render homepage
	 * Require admin or publisher role
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function edit(): void
	{
		if ($this->hasRoles(['admin', 'publisher'])) {
			$edited = $this->model->edit(filter_input(INPUT_POST, 'title'),
				filter_input(INPUT_POST, 'message'),
				filter_input(INPUT_POST, 'author'),
				(int)filter_input(INPUT_GET, 'id'));
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