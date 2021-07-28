<?php

namespace Controllers;

class Page extends Controller
{
	protected $modelName = \Models\Post::class;
	
	public function showHome(): void
	{
		echo $this->twig->render('home.twig');
	}
	
	public function showAdd(): void
	{
		if ($this->hasPermission()) {
			echo $this->twig->render('add_post.twig');
		} else {
			$this->forbidden();
		}
	}
	
	public function showEdit(): void
	{
		if ($this->hasPermission()) {
			$value = $this->model->getEditValues((int)filter_input(INPUT_GET, 'id'));
			echo $this->twig->render('edit_post.twig', compact('value'));
		} else {
			$this->forbidden();
		}
	}
	
	public function show404(): void
	{
		header('HTTP/1.0 404 Not Found');
		echo $this->twig->render('404.twig');
	}
	
	public function forbidden(): void
	{
		header('HTTP/1.0 403 Forbidden');
		echo $this->twig->render('forbidden.twig');
	}
}