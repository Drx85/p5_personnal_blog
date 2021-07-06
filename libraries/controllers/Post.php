<?php

namespace Controllers;

class Post extends Controller
{
	public function displayPosts($user_message)
	{
		$blog = $this->post->findAll();
		$rounded_page_number = $this->pages->count();
		$array_pages = $this->pages->get();
		$comments_number = $this->comment->count();
		
		$error_page = true;
		$increment_comments_number = 0;
		require('view/frontend/index_view.php');
	}
	
	public function adminSendPost()
	{
		$this->post->insert($_POST['title'], $_POST['post_content'], $_SESSION['pseudo']);
		header('Location: index.php?send_post=true');
	}
	
	public function adminDeletePost()
	{
		$this->post->delete($_GET['delete_post']);
		header('Location: index.php?deleted_post=true');
	}
	
	public function formEditPost()
	{
		$edit_values = $this->admin->valuesEditPost($_GET['edit_post']);
		require('view/backend/edit_form.php');
	}
	
	public function adminEditPost()
	{
		$this->post->edit($_POST['edit_title'], $_POST['edit_post_content'], $_POST['edit_author'], $_GET['sent_edit_post']);
		header('Location: index.php?edited_post=true');
	}
	
}