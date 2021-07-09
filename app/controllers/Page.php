<?php

namespace Controllers;

class Page extends Controller
{
	public function showHome()
	{
		echo $this->twig->render('home.twig');
	}
	
	public function show404()
	{
		header('HTTP/1.0 404 Not Found');
		echo $this->twig->render('404.twig');
	}
}