<?php

namespace Controllers;

use Message;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Mail extends Controller
{
	protected $modelName = \Models\Mail::class;
	
	/**
	 * Ask model to send email from form contact and render homepage
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function submit(): void
	{
		$surname = filter_input(INPUT_POST, 'surname');
		$name = filter_input(INPUT_POST, 'name');
		$email = filter_input(INPUT_POST, 'email');
		$message = filter_input(INPUT_POST, 'message');
		
		$mail = new \Entities\Mail();
		$mail->setSurname($surname)
			->setName($name)
			->setEmail($email)
			->setMessage($message);
		$mail = $this->model->send($mail);
		if ($mail === true) {
			echo $this->twig->render('home.twig', ['message' => Message::SENT_MAIL]);
		} else {
			echo $this->twig->render('home.twig', ['message' => $mail]);
		}
	}
}