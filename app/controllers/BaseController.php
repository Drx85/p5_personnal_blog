<?php


namespace Controllers;


class BaseController extends Controller
{
	public function forbidden(): void
	{
		header('HTTP/1.0 403 Forbidden');
		echo $this->twig->render('forbidden.twig');
	}
	
	public function show404(): void
	{
		header('HTTP/1.0 404 Not Found');
		echo $this->twig->render('404.twig');
	}
	
}