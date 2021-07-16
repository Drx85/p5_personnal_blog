<?php

namespace Controllers;

use Message;

class Mail extends Controller
{
	protected $modelName = \Models\Mail::class;
	
	public function submit()
	{
		$this->model->send($_POST['surname'], $_POST['name'], $_POST['email'], $_POST['message']);
		echo $this->twig->render('home.twig', ['message' => Message::SENT_MAIL]);
	}
}