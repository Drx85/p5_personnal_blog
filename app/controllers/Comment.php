<?php

namespace Controllers;

use Message;

class Comment extends Controller
{
	protected $modelName = \Models\Comment::class;
	
	public function send()
	{
		$this->model->insert($_GET['id_post'], $_SESSION['user']->getPseudo(), $_POST['user_comment']);
		echo $this->twig->render('home.twig', ['message' => Message::SENT_COMMENT]);
	}
	
	public function delete()
	{
		if ($this->hasPermission()) {
			$deleted = $this->model->delete($_GET['id']);
			if ($deleted) {
				echo $this->twig->render('home.twig', ['message' => Message::DELETED_COMMENT]);
				exit;
			}
			echo $this->twig->render('home.twig', ['message' => Message::UNDEFINED_COMMENT]);
			exit;
		}
		$this->forbidden();
	}
	
	public function showPending()
	{
		if ($this->hasPermission()) {
			$comments = $this->model->findAllByPost(0);
			echo $this->twig->render('awaiting_validation.twig', compact('comments'));
			exit;
		}
		$this->forbidden();
	}
	
	public function validate()
	{
		if ($this->hasPermission()) {
			$validate = $this->model->validate($_GET['id']);
			if ($validate) {
				echo $this->twig->render('home.twig', ['message' => Message::VALIDATED_COMMENT]);
				exit;
			}
			echo $this->twig->render('home.twig', ['message' => Message::UNDEFINED_COMMENT]);
			exit;
		}
		$this->forbidden();
	}
}