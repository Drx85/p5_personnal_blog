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
		if ($this->hasPermission()) {
			echo $this->twig->render('add_post.twig');
		} else {
			$this->forbidden();
		}
	}
	
	public function showEdit()
	{
		if ($this->hasPermission()) {
		$value = $this->post->getEditValues($_GET['id']);
		echo $this->twig->render('edit_post.twig', compact('value'));
		} else {
			$this->forbidden();
		}
	}
	
	public function show404()
	{
		header('HTTP/1.0 404 Not Found');
		echo $this->twig->render('404.twig');
	}
}