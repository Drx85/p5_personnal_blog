<?php

namespace Controllers;

use Message;

class Comment extends Controller
{
	public function send()
	{
		$this->comment->insert($_GET['id_post'], $_SESSION['pseudo'], $_POST['user_comment']);
		echo $this->twig->render('home.twig', ['message' => Message::SENT_COMMENT]);
	}
	
	public function delete()
	{
		if ($this->hasPermission()) {
			$this->comment->delete($_GET['id']);
			echo $this->twig->render('home.twig', ['message' => Message::DELETED_COMMENT]);
		} else {
			$this->forbidden();
		}
	}
	
	public function showPending()
	{
		if ($this->hasPermission()) {
			$comments = $this->comment->findAll(0);
			echo $this->twig->render('awaiting_validation.twig', compact('comments'));
		} else {
			$this->forbidden();
		}
	}
	
	public function validate()
	{
		if ($this->hasPermission()) {
			$this->comment->validate($_GET['id']);
			echo $this->twig->render('home.twig', ['message' => Message::VALIDATED_COMMENT]);
		} else {
			$this->forbidden();
		}
	}
}