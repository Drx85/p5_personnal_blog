<?php

namespace Controllers;

require_once('../app/autoload.php');

$page = 'home';
if (isset($_GET['p'])) {
	$page = $_GET['p'];
}

$action = 'showHome';
if (isset($_GET['action'])) {
	$action = $_GET['action'];
}

if (!isset($_GET['page']) or $_GET['page'] > 1000 or $_GET['page'] < 1) {
	$_GET['page'] = 1;
}

switch ($page) {
	case 'home':
		switch ($action) {
			case 'showHome':
				$controller = new \Controllers\Page();
				$controller->showHome();
				break;
				
			case 'disconnect':
				$controller = new \Controllers\Account();
				$controller->disconnect();
				break;
		}
		break;
	
	case 'posts':
		$controller = new \Controllers\Post();
		$controller->index();
		break;
	
	case 'post':
		$controller = new \Controllers\Post();
		$controller->show();
		break;
	
	case 'register':
		$controller = new \Controllers\Account();
		
		switch ($action) {
			case 'showRegister':
				$controller->showRegister();
				break;
			
			case 'register':
				$controller->register();
				break;
		}
		break;
	
	case 'connection':
		$controller = new \Controllers\Account();
		
		switch ($action) {
			case 'showConnection':
				$controller->showConnection();
				break;
			
			case 'connect':
				$controller->connect();
				break;
		}
		break;
	
	default:
		$controller = new \Controllers\Page();
		$controller->show404();
		break;
}




/*//BACK
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
}*/
