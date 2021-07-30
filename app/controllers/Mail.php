<?php

namespace Controllers;

use Message;

class Mail extends BaseController
{
	protected $modelName = \Models\Mail::class;
	
	/**
	 * Ask model to send email from form contact and render homepage
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function submit(): void
	{
		$this->model->send(filter_input(INPUT_POST, 'surname'),
			filter_input(INPUT_POST, 'name'),
			filter_input(INPUT_POST, 'email'),
			filter_input(INPUT_POST, 'message'));
		echo $this->twig->render('home.twig', ['message' => Message::SENT_MAIL]);
	}
}