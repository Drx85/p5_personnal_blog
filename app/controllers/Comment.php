<?php

namespace Controllers;

use Message;
use Session;

class Comment extends Controller
{
	protected $modelName = \Models\Comment::class;
	
	public function send()
	{
		$this->model->insert($_GET['id_post'], Session::get('user')->getPseudo(), $_POST['user_comment']);
		echo $this->twig->render('home.twig', ['message' => Message::SENT_COMMENT]);
	}
	
	public function showPending()
	{
		if ($this->hasPermission()) {
			$comments = $this->model->findAllByPost(0);
			echo $this->twig->render('awaiting_validation.twig', compact('comments'));
		} else {
			$this->forbidden();
		}
	}
	
	public function validate()
	{
		if ($this->hasPermission()) {
			$validate = $this->model->validate($_GET['id']);
			if ($validate) {
				echo $this->twig->render('home.twig', ['message' => Message::VALIDATED_COMMENT]);
			} else {
				echo $this->twig->render('home.twig', ['message' => Message::UNDEFINED_COMMENT]);
			}
		} else {
			$this->forbidden();
		}
	}
}