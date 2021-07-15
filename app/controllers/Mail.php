<?php

namespace Controllers;
use Message;

class Mail extends Controller
{
	public function submit()
	{
		$this->mail->send($_POST['surname'], $_POST['name'], $_POST['email'], $_POST['message']);
		echo $this->twig->render('home.twig', ['message' => Message::SENT_MAIL]);
	}
}