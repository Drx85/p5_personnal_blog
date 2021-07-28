<?php

namespace Controllers;

use Message;

class Mail extends Controller
{
	protected $modelName = \Models\Mail::class;
	
	public function submit()
	{
		$this->model->send(filter_input(INPUT_POST, 'surname'),
			filter_input(INPUT_POST, 'name'),
			filter_input(INPUT_POST, 'email'),
			filter_input(INPUT_POST, 'message'));
		echo $this->twig->render('home.twig', ['message' => Message::SENT_MAIL]);
	}
}