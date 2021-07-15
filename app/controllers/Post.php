<?php

namespace Controllers;
use Message;

class Post extends Controller
{
	public function index()
	{
		$blog = $this->post->findAll();
		$array_pages = $this->pages->get();
		$comments_number = $this->comment->count();
		echo $this->twig->render('posts.twig', compact('blog', 'comments_number', 'array_pages'));
	}
	
	public function show()
	{
		$post = $this->post->find($_GET['id']);
		$comments = $this->comment->findAll(1, $_GET['id']);
		echo $this->twig->render('post.twig', compact('post', 'comments'));
	}
	
	public function add()
	{
		if ($this->hasPermission()) {
		$this->post->insert($_POST['title'], $_POST['post_content'], $_SESSION['pseudo']);
		echo $this->twig->render('home.twig', ['message' => Message::ADDED]);
		} else {
			$this->forbidden();
		}
	}
	
	public function delete()
	{
		if ($this->hasPermission()) {
		$this->post->delete($_GET['id']);
		echo $this->twig->render('home.twig', ['message' => Message::DELETED_POST]);
		} else {
			$this->forbidden();
		}
	}
	
	public function edit()
	{
		if ($this->hasPermission()) {
		$this->post->edit($_POST['title'], $_POST['message'], $_POST['author'], $_GET['id']);
		echo $this->twig->render('home.twig', ['message' => Message::EDITED]);
		} else {
			$this->forbidden();
		}
	}
}