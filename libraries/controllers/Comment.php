<?php

namespace Controllers;

class Comment extends Controller
{
	public function displayComments()
	{
		$post = $this->post->find($_GET['comment']);
		$blog_comments = $this->comment->findAll($_GET['comment']);
		require('view/frontend/comments_view.php');
	}
	
	public function sendComment()
	{
		$this->comment->insert($_GET['send_comment'], $_SESSION['pseudo'], $_POST['user_comment']);
		header('Location: index.php?comment=' . $_GET['send_comment']);
	}
	
	public function adminDeleteComment()
	{
		$this->comment->delete($_GET['delete_comment']);
		header('Location: index.php?deleted_comment=true');
	}
	
}