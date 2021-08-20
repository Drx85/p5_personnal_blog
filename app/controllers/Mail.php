<?php

namespace Controllers;

use Message;
use PHPMailer\PHPMailer\Exception;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Mail extends Controller
{
	/**
	 * Ask manager to send email from form contact and render homepage
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 * @throws Exception
	 */
	public function submit(): void
	{
		$success = new \Service\Mail(filter_input(INPUT_POST, 'surname'),
			filter_input(INPUT_POST, 'name'),
			filter_input(INPUT_POST, 'email'),
			filter_input(INPUT_POST, 'message'));

		if ($success === true) {
			echo $this->twig->render('home.twig', ['message' => Message::SENT_MAIL]);
		} else {
			echo $this->twig->render('home.twig', ['message' => $success]);
		}
	}
}