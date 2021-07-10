<?php

namespace Controllers;

class Page extends Controller
{
	public function showHome()
	{
		echo $this->twig->render('home.twig');
	}
	
	public function showAdd()
	{
		echo $this->twig->render('add_post.twig');
	}
	
	public function showEdit()
	{
		$value = $this->post->getEditValues($_GET['id']);
		echo $this->twig->render('edit_post.twig', compact('value'));
	}
	
	public function show404()
	{
		header('HTTP/1.0 404 Not Found');
		echo $this->twig->render('404.twig');
	}
	
	public function forbidden()
	{
		header('HTTP/1.0 403 Forbidden');
		echo $this->twig->render('forbidden.twig');
	}
}