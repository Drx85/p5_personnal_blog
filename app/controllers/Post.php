<?php

namespace Controllers;

class Post extends Controller
{
	public function index()
	{
		$blog = $this->post->findAll();
		$array_pages = $this->pages->get();
		$comments_number = $this->comment->count();
		echo $this->twig->render('posts.twig', compact('blog', 'comments_number', 'array_pages'));
	}
	
	public function show()
	{
		$post = $this->post->find($_GET['id']);
		$comments = $this->comment->findAll($_GET['id']);
		echo $this->twig->render('post.twig', compact('post', 'comments'));
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
		require('../public/backend/edit_form.php');
	}
	
	public function adminEditPost()
	{
		$this->post->edit($_POST['edit_title'], $_POST['edit_post_content'], $_POST['edit_author'], $_GET['sent_edit_post']);
		header('Location: index.php?edited_post=true');
	}
	
}