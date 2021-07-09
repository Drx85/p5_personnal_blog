<?php

namespace Controllers;

class Page extends Controller
{
	public function showHome()
	{
		echo $this->twig->render('home.twig');
	}
}