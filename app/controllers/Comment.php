<?php

namespace Controllers;

use Message;

class Comment extends Controller
{
	public function send()
	{
		$this->comment->insert($_GET['id_post'], $_SESSION['pseudo'], $_POST['user_comment']);
		echo $this->twig->render('home.twig', ['message' => Message::ADDED]);
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
}