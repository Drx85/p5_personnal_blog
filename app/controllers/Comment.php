<?php

namespace Controllers;

use Message;
use Session;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Comment extends Controller
{
	protected $modelName = \Models\Comment::class;
	
	/**
	 * Ask model to send a comment to awaiting validation list, and render homepage
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function send(): void
	{
		$id_post = (int)filter_input(INPUT_GET, 'id_post');
		$author = Session::get('user')->getPseudo();
		$text = filter_input(INPUT_POST, 'user_comment');
		$comment = new \Entities\Comment();
		$comment->setIdPost($id_post)
			->setAuthor($author)
			->setText($text)
			->setCommentDate(date('Y-m-d'))
			->setCommentTime(date('H:i:s'));
		$this->model->insert($comment);
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
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function validate(): void
	{
		if ($this->hasRoles(['admin', 'publisher'])) {
			$id = (int)filter_input(INPUT_GET, 'id');
			$comment = new \Entities\Comment();
			$comment->setId($id);
			$validated = $this->model->validate($comment);
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