<?php

require_once(__DIR__ . '/model/Post.php');
require_once(__DIR__ . '/model/Comment.php');
require_once(__DIR__ . '/model/Page.php');
require_once(__DIR__ . '/model/Account.php');
require_once(__DIR__ . '/model/Admin.php');

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
    $post = new Post();
    $pages = new Page();
    $comment = new Comment();

    $blog = $post->findAll();
    $rounded_page_number = $pages->count();
    $array_pages = $pages->get();
    $comments_number = $comment->count();

    $error_page = true;
    $increment_comments_number = 0;
    require(__DIR__ . '/view/frontend/index_view.php');
}

function displayComments()
{
    $post = new Post();
    $comment = new Comment();

    $post = $post->find($_GET['comment']);
    $blog_comments = $comment->findAll();
    require(__DIR__ . '/view/frontend/comments_view.php');
}

function sendComment()
{
    $comment = new Comment();
    $comment->insert();
    header('Location: index.php?comment=' . $_GET['send_comment']);
}

function register()
{
	$account = new Account();
	
	$exists = $account->exists($_POST['pseudo'], $_POST['mail']);
	if ($exists === false) {
	$account->create($_POST['pseudo'], $_POST['password'], $_POST['mail']);
	}
	else {
		return $exists;
	}
}

function UserConnected()
{
	$account = new Account();
	return $account->connect($_POST['password'], $_POST['username']);
}

function adminSendPost()
{
	$post = new Post();
	$post->insert();
	header('Location: index.php?send_post=true');
}

function adminDeletePost()
{
	$post = new Post();
	$post->delete($_GET['delete_post']);
	header('Location: index.php?deleted_post=true');
}

function formEditPost()
{
	$admin = new Admin();
	$edit_values = $admin->valuesEditPost();
	require(__DIR__ . '/view/backend/edit_form.php');
}

function adminEditPost()
{
	$post = new Post();
	$post->edit();
	header('Location: index.php?edited_post=true');
}

function adminDeleteComment()
{
	$comment = new Comment();
	$comment->delete($_GET['delete_comment']);
	header('Location: index.php?deleted_comment=true');
}