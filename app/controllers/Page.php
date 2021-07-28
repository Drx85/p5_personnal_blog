<?php

namespace Controllers;

class Page extends Controller
{
	protected $modelName = \Models\Post::class;
	
	public function showHome()
	{
		echo $this->twig->render('home.twig');
	}
	
	public function showAdd()
	{
		if ($this->hasPermission()) {
			echo $this->twig->render('add_post.twig');
			exit;
		}
		$this->forbidden();
	}
	
	public function showEdit()
	{
		if ($this->hasPermission()) {
			$value = $this->model->getEditValues((int)filter_input(INPUT_GET, 'id'));
			echo $this->twig->render('edit_post.twig', compact('value'));
			exit;
		}
		$this->forbidden();
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