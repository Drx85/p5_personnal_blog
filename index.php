<?php

require('controller/frontend.php');

try
{
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
        displayPosts();
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
					
				default:
					header('Location: view/frontend/success_register.php');
			}
		}
		else {
			header('Location: view/frontend/register.php?field=empty');
		}
	}
}

catch(Exception $e)
{
    echo 'Erreur : ' . $e->getMessage();
}