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
}

catch(Exception $e)
{
    echo 'Erreur : ' . $e->getMessage();
}