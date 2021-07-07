<?php

namespace Controllers;

require_once('../app/autoload.php');

$user_message = false;

try
{
	//FRONT
	if(isset ($_GET['notify'])) {
		switch ($_GET['notify']) {
			case 'privilege':
				$user_message = 'Vous n\'avez pas les droits pour effectuer cette action.';
				break;
				
			case 'post_modified':
				$user_message = 'Le billet a bien été modifié.';
				break;
			
			case 'post_deleted':
				$user_message = 'Le billet a bien été supprimé.';
				break;
				
			case 'comment_deleted':
				$user_message = 'Le commentaire a bien été supprimé.';
				break;
				
			case 'added_post':
				$user_message = 'Le billet a bien été ajouté.';
				break;
		}
	}
	
    if (! isset($_GET['page']) OR $_GET['page'] > 1000 OR $_GET['page'] < 0)
    {
        $_GET['page'] = 1;
    }

    else
    {
        $_GET['page'] = (int) $_GET['page'];
    }


    if (isset($_GET['comment']))
    {
        $_GET['comment'] = (int) $_GET['comment'];
    }

    if (! isset($_GET['comment']) OR $_GET['comment'] > 1000 OR $_GET['comment'] <= 0)
    {
    	$controller = new \Controllers\Post();
        $controller->displayPosts($user_message);
    }

    else
    {
    	$controller = new Comment();
        $controller->displayComments();
    }
    
	if (isset($_GET['send_comment']))
	{
		if (! empty($_POST['user_comment']) OR $_POST['user_comment'] === '0')
		{
			$controller = new Comment();
			$controller->sendComment();
		}
		
		else
		{
			throw new Exception('empty_comment', 1);
		}
	}
	
	if (isset($_GET['p']))
	{
		switch ($_GET['p']) {
			case 'register':
				header('Location: frontend/register.php');
				break;
				
			case 'connexion':
				header('Location: frontend/connexion.php');
				break;
		}
	}

	if (isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['password']))
	{
		if (!empty($_POST['pseudo']) && !empty($_POST['mail']) && !empty($_POST['password']))
		{
			$controller = new Account();
			switch ($controller->register()) {
				case 'pseudoExists':
					header('Location: frontend/register.php?exists=pseudo');
					break;
					
				case 'emailExists':
					header('Location: frontend/register.php?exists=mail');
					break;
					
				case 'pseudoMailExists':
					header('Location: frontend/register.php?exists=pseudomail');
					break;
					
				default:
					header('Location: frontend/redirect.php?redirect=register');
			}
		}
		else {
			header('Location: frontend/register.php?field=empty');
		}
	}
	
	if (isset($_POST['username']) && isset($_POST['password']))
	{
		$controller = new Account();
		if ($controller->userConnected() === true) {
			header('Location: index.php');
		}
		else {
			header('Location: frontend/connexion.php?connect=false');
		}
	}

//BACK
	if (isset($_POST['title']) AND isset($_POST['post_content']))
	{
		if (! empty($_POST['title']) AND ! empty($_POST['post_content']))
		{
			$controller = new Post();
			$controller->adminSendPost();
		}
		else
		{
			header('Location: backend/add_form.php?empty_field=true');
		}
	}
	
	if(isset($_GET['send_post']) AND ($_GET['send_post']))
	{
		throw new Exception('added_post');
	}
	
	
	if (isset($_GET['delete_post']))
	{
		if (isset($_SESSION['user_id'])) {
			$controller = new Post();
			$controller->adminDeletePost();
		}
		else {
			throw new Exception('privilege');
		}
	}
	
	if(isset($_GET['deleted_post']) AND ($_GET['deleted_post']))
	{
		throw new Exception('post_deleted');
	}
	
	
	if(isset($_GET['edit_post']))
	{
		if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' || isset($_SESSION['role']) && $_SESSION['role'] === 'publisher') {
			$controller = new Post();
			$controller->formEditPost();
		}
		else {
			throw new Exception('privilege');
		}
	}
	
	if(isset($_GET['sent_edit_post']))
	{
		if (isset($_SESSION['user_id'])) {
			$controller = new Post();
			$controller->adminEditPost();
		}
		else {
			throw new Exception('privilege');
		}
	}
	
	if(isset($_GET['edited_post']) AND ($_GET['edited_post']))
	{
		throw new Exception('post_modified');
	}
	
	if (isset($_GET['delete_comment']))
	{
		if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' || isset($_SESSION['role']) && $_SESSION['role'] === 'publisher') {
			$controller = new Comment();
			$controller->adminDeleteComment();
		}
		else {
			throw new Exception('privilege');
		}
	}
	
	if(isset($_GET['deleted_comment']) AND ($_GET['deleted_comment']))
	{
		throw new Exception('comment_deleted');
	}
}

catch(Exception $e)
{
	if ($e->getCode() === 1) {
		header('Location: index.php?comment=' . $_GET['send_comment'] . '&notify=' . $e->getMessage() . '');
	}
	else {
		header('Location: index.php?notify=' . $e->getMessage() . '');
	}
}
