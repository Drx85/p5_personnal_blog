<?php

namespace Controllers;

use Message;
use Session;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Comment extends Controller
{
	protected $managerName = \Managers\Comment::class;
	
	/**
	 * Ask manager to send a comment to awaiting validation list, and render homepage
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function send(): void
	{
		$idPost = (int)filter_input(INPUT_GET, 'id_post');
		$author = Session::get('user')->getPseudo();
		$text = filter_input(INPUT_POST, 'user_comment');
		$comment = new \Entities\Comment(compact('idPost', 'author', 'text'));
		$comment->setDate(date('Y-m-d'))
			->setTime(date('H:i:s'));
		$this->manager->insert($comment);
		echo $this->twig->render('home.twig', ['message' => Message::SENT_COMMENT]);
	}
	
	/**
	 * Render awaiting validation comments page
	 * Require admin or publisher role
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function showPending(): void
	{
		if ($this->hasRoles(['admin', 'publisher'])) {
			$comments = $this->manager->findAllByPost(0);
			echo $this->twig->render('awaiting_validation.twig', compact('comments'));
		} else {
			$this->forbidden();
		}
	}
	
	/**
	 * Ask manager to validate asked comment for it to be showed in public, and render homepage
	 * Require admin or publisher role
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function validate(): void
	{
		if ($this->hasRoles(['admin', 'publisher'])) {
			$id = (int)filter_input(INPUT_GET, 'id');
			$comment = new \Entities\Comment(compact('id'));
			$validated = $this->manager->validate($comment);
			if ($validated > 0) {
				echo $this->twig->render('home.twig', ['message' => Message::VALIDATED_COMMENT]);
			} else {
				echo $this->twig->render('home.twig', ['message' => Message::UNDEFINED_CONTENT]);
			}
		} else {
			$this->forbidden();
		}
	}
}