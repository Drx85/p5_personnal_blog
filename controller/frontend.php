<?php

require_once (__DIR__ . '/../model/frontend/PostManager.php');
require_once (__DIR__ . '/../model/frontend/CommentManager.php');
require_once (__DIR__ . '/../model/frontend/PagesManager.php');

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
    require(__DIR__ . '/../view/frontend/index_view.php');
}

function displayComments()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->linkedPost();
    $blog_comments = $commentManager->listComments();
    require(__DIR__ . '/../view/frontend/comments_view.php');
}

function sendComment()
{
    $commentManager = new CommentManager();

    $commentManager->insertComment();
    header('Location: index.php?comment=' . $_GET['send_comment']);
}