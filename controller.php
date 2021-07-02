<?php

require_once(__DIR__ . '/model/PostManager.php');
require_once(__DIR__ . '/model/CommentManager.php');
require_once(__DIR__ . '/model/PagesManager.php');
require_once(__DIR__ . '/model/AccountManager.php');
require_once(__DIR__ . '/model/AdminManager.php');

function troncate($text, $char_nb, $delim='...')
{
	$length = $char_nb;
	if($char_nb<strlen($text)){
		while (($text{$length} != " ") && ($length > 0)) {
			$length--;
		}
		if ($length == 0) return substr($text, 0, $char_nb) . $delim;
		else return substr($text, 0, $length) . $delim;
	}else return $text;
}

function displayPosts($user_message)
{
    $postManager = new PostManager();
    $pagesManager = new PagesManager();
    $commentManager = new CommentManager();

    $blog = $postManager->listPosts();
    $rounded_page_number = $pagesManager->countPages();
    $array_pages = $pagesManager->getPages();
    $comments_number = $commentManager->countComments();

    $error_page = true;
    $increment_comments_number = 0;
    require(__DIR__ . '/view/frontend/index_view.php');
}

function displayComments()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->linkedPost();
    $blog_comments = $commentManager->listComments();
    require(__DIR__ . '/view/frontend/comments_view.php');
}

function sendComment()
{
    $commentManager = new CommentManager();
    $commentManager->insertComment();
    header('Location: index.php?comment=' . $_GET['send_comment']);
}

function register()
{
	$accountManager = new AccountManager();
	
	$exists = $accountManager->exists($_POST['pseudo'], $_POST['mail']);
	if ($exists === false) {
	$accountManager->createAccount();
	}
	else {
		return $exists;
	}
}

function UserConnected()
{
	$accountManager = new AccountManager();
	return $accountManager->userConnect($_POST['password'], $_POST['username']);
}

function adminSendPost()
{
	$adminManager = new AdminManager();
	$adminManager->insertPost();
	header('Location: index.php?send_post=true');
}

function adminDeletePost()
{
	$adminManager = new AdminManager();
	$adminManager->deletePost();
	header('Location: index.php?deleted_post=true');
}

function formEditPost()
{
	$adminManager = new AdminManager();
	$edit_values = $adminManager->valuesEditPost();
	require(__DIR__ . '/view/backend/edit_form.php');
}

function adminEditPost()
{
	$adminManager = new AdminManager();
	$adminManager->editPost();
	header('Location: index.php?edited_post=true');
}

function adminDeleteComment()
{
	$adminManager = new AdminManager();
	$adminManager->deleteComment();
	header('Location: index.php?deleted_comment=true');
}