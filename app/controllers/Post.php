<?php

namespace Controllers;

use Message;

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
			$this->model->insert($_POST['title'], $_POST['post_content'], $_SESSION['user']->getPseudo());
			echo $this->twig->render('home.twig', ['message' => Message::ADDED]);
		} else {
			$this->forbidden();
		}
	}
	
	public function delete()
	{
		if ($this->hasPermission()) {
			$this->model->delete($_GET['id']);
			echo $this->twig->render('home.twig', ['message' => Message::DELETED_POST]);
		} else {
			$this->forbidden();
		}
	}
	
	public function edit()
	{
		if ($this->hasPermission()) {
			$this->model->edit($_POST['title'], $_POST['message'], $_POST['author'], $_GET['id']);
			echo $this->twig->render('home.twig', ['message' => Message::EDITED]);
		} else {
			$this->forbidden();
		}
	}
}