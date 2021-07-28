<?php

namespace Controllers;

use Message;
use Session;

class Comment extends Controller
{
	protected $modelName = \Models\Comment::class;
	
	public function send(): void
	{
		$this->model->insert((int)filter_input(INPUT_GET, 'id_post'), Session::get('user')->getPseudo(), filter_input(INPUT_POST, 'user_comment'));
		echo $this->twig->render('home.twig', ['message' => Message::SENT_COMMENT]);
	}
	
	public function showPending(): void
	{
		if ($this->hasPermission()) {
			$comments = $this->model->findAllByPost(0);
			echo $this->twig->render('awaiting_validation.twig', compact('comments'));
		} else {
			$this->forbidden();
		}
	}
	
	public function validate(): void
	{
		if ($this->hasPermission()) {
			$validate = $this->model->validate((int)filter_input(INPUT_GET, 'id'));
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