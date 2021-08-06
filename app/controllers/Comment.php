<?php

namespace Controllers;

use Message;
use Session;

class Comment extends Controller
{
	protected $modelName = \Models\Comment::class;
	
	/**
	 * Ask model to send a comment to awaiting validation list, and render homepage
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function send(): void
	{
		$this->model->insert((int)filter_input(INPUT_GET, 'id_post'), Session::get('user')->getPseudo(), filter_input(INPUT_POST, 'user_comment'));
		echo $this->twig->render('home.twig', ['message' => Message::SENT_COMMENT]);
	}
	
	/**
	 * Render awaiting validation comments page
	 * Require admin or publisher role
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function showPending(): void
	{
		if ($this->hasRoles(['admin', 'publisher'])) {
			$comments = $this->model->findAllByPost(0);
			echo $this->twig->render('awaiting_validation.twig', compact('comments'));
		} else {
			$this->forbidden();
		}
	}
	
	/**
	 * Ask model to validate asked comment for it to be showed in public, and render homepage
	 * Require admin or publisher role
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function validate(): void
	{
		if ($this->hasRoles(['admin', 'publisher'])) {
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