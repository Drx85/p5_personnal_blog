<?php

require('controller.php');
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


    if (isset($_GET['send_comment']))
    {
        if (! empty($_POST['pseudo']) AND ! empty($_POST['user_comment']) OR $_POST['user_comment'] === '0')
        {
            sendComment();
        }

        else
        {
            header('Location: index.php?comment=' . $_GET['send_comment'] . '&empty=true');
        }
    }

    if (! isset($_GET['comment']) OR $_GET['comment'] > 1000 OR $_GET['comment'] <= 0)
    {
        displayPosts($user_message);
    }

    else
    {
        displayComments();

        if (isset($_GET['empty']))
        {
            throw new Exception('Il faut rentrer un pseudo et un message.');
        }
    }
	
	if (isset($_GET['p']))
	{
		switch ($_GET['p']) {
			case 'register':
				header('Location: view/frontend/register.php');
				break;
				
			case 'connexion':
				header('Location: view/frontend/connexion.php');
				break;
		}
	}

	if (isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['password']))
	{
		if (!empty($_POST['pseudo']) && !empty($_POST['mail']) && !empty($_POST['password']))
		{
			switch (register()) {
				case 'pseudoExists':
					header('Location: view/frontend/register.php?exists=pseudo');
					break;
					
				case 'emailExists':
					header('Location: view/frontend/register.php?exists=mail');
					break;
					
				case 'pseudoMailExists':
					header('Location: view/frontend/register.php?exists=pseudomail');
					break;
					
				default:
					header('Location: view/frontend/redirect.php?redirect=register');
			}
		}
		else {
			header('Location: view/frontend/register.php?field=empty');
		}
	}
	
	if (isset($_POST['username']) && isset($_POST['password']))
	{
		if (userConnected() === true) {
			header('Location: index.php');
		}
		else {
			header('Location: view/frontend/connexion.php?connect=false');
		}
	}

//BACK
	if (isset($_POST['title']) AND isset($_POST['post_content']))
	{
		if (! empty($_POST['title']) AND ! empty($_POST['post_content']))
		{
			adminSendPost();
		}
		else
		{
			header('Location: ../view/backend/add_form.php?empty_field=true');
		}
	}
	
	if(isset($_GET['send_post']) AND ($_GET['send_post']))
	{
		header('Location: index.php?notify=added_post');
	}
	
	
	if (isset($_GET['delete_post']))
	{
		if (isset($_SESSION['user_id'])) {
			adminDeletePost();
		}
		else {
			header('Location: index.php?notify=privilege');
		}
	}
	
	if(isset($_GET['deleted_post']) AND ($_GET['deleted_post']))
	{
		header('Location: index.php?notify=post_deleted');
	}
	
	
	if(isset($_GET['edit_post']))
	{
		if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' || isset($_SESSION['role']) && $_SESSION['role'] === 'publisher') {
			formEditPost();
		}
		else {
			header('Location: index.php?notify=privilege');
		}
	}
	
	if(isset($_GET['sent_edit_post']))
	{
		if (isset($_SESSION['user_id'])) {
			adminEditPost();
		}
		else {
			header('Location: index.php?notify=privilege');
		}
	}
	
	if(isset($_GET['edited_post']) AND ($_GET['edited_post']))
	{
		header('Location: index.php?notify=post_modified');
	}
	
	
	if (isset($_GET['delete_comment']))
	{
		if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' || isset($_SESSION['role']) && $_SESSION['role'] === 'publisher') {
			adminDeleteComment();
		}
		else {
			header('Location: index.php?notify=privilege');
		}
	}
	
	if(isset($_GET['deleted_comment']) AND ($_GET['deleted_comment']))
	{
		header('Location: index.php?notify=comment_deleted');
	}
}

catch(Exception $e)
{
    echo 'Erreur : ' . $e->getMessage();
}
