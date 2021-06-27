<?php

require_once (__DIR__ . '/../model/frontend/PostManager.php');
require_once (__DIR__ . '/../model/frontend/CommentManager.php');
require_once (__DIR__ . '/../model/frontend/PagesManager.php');
require_once (__DIR__ . '/../model/backend/AdminManager.php');

function adminSendPost()
{
    $adminManager = new AdminManager();
    $adminManager->insertPost();
    header('Location: back_index.php?send_post=true');
}

function adminDeletePost()
{
    $adminManager = new AdminManager();
    $adminManager->deletePost();
    header('Location: back_index.php?deleted_post=true');
}

function formEditPost()
{
    $adminManager = new AdminManager();
    $edit_values = $adminManager->valuesEditPost();
    require(__DIR__ . '/../view/backend/edit_form.php');
}

function adminEditPost()
{
    $adminManager = new AdminManager();
    $adminManager->editPost();
    header('Location: back_index.php?edited_post=true');
}

function adminDeleteComment()
{
    $adminManager = new adminManager();
    $adminManager->deleteComment();
    header('Location: back_index.php?deleted_comment=true');
}

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

function displayPosts()
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
    require(__DIR__ . '/../view/backend/index_view.php');
}

function displayComments()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->linkedPost();
    $blog_comments = $commentManager->listComments();
    require(__DIR__ . '/../view/backend/comments_view.php');
}

function sendComment()
{
    $commentManager = new CommentManager();

    $commentManager->insertComment();
    header('Location: back_index.php?comment=' . $_GET['send_comment']);
}