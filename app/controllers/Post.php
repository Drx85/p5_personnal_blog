<?php

namespace Controllers;

use Message;
use Session;

class Post extends Controller
{
	protected $modelName = \Models\Post::class;
	
	public function index()
	{
		$pages = new \Models\Page();
		$comment = new \Models\Comment();
		
		$blog = $this->model->findAll();
		$array_pages = $pages->get();
		$comments_number = $comment->count();
		echo $this->twig->render('posts.twig', compact('blog', 'comments_number', 'array_pages'));
	}
	
	public function show()
	{
		$comment = new \Models\Comment();
		$post = $this->model->find($_GET['id']);
		$comments = $comment->findAllByPost(1, $_GET['id']);
		echo $this->twig->render('post.twig', compact('post', 'comments'));
	}
	
	public function add()
	{
		if ($this->hasPermission()) {
			$added = $this->model->insert($_POST['title'], $_POST['post_content'], Session::get('user')->getPseudo());
			if ($added) {
				echo $this->twig->render('home.twig', ['message' => Message::ADDED]);
				exit;
			}
			echo $this->twig->render('home.twig', ['message' => Message::TITLE_ALREADY_EXISTS]);
			exit;
		}
		$this->forbidden();
	}
	
	public function edit()
	{
		if ($this->hasPermission()) {
			$edited = $this->model->edit($_POST['title'], $_POST['message'], $_POST['author'], $_GET['id']);
			if ($edited) {
				echo $this->twig->render('home.twig', ['message' => Message::EDITED]);
				exit;
			}
			echo $this->twig->render('home.twig', ['message' => Message::TITLE_ALREADY_EXISTS]);
			exit;
		}
		$this->forbidden();
	}
}