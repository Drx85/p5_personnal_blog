<?php

require(__DIR__ . '/../controller/backend.php');

try
{
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
        echo '<p>Le billet a bien été ajouté !</p>';
    }


    if (isset($_GET['delete_post']))
    {
        adminDeletePost();
    }

    if(isset($_GET['deleted_post']) AND ($_GET['deleted_post']))
    {
        echo '<p>Le billet a bien été supprimé !</p>';
    }


    if(isset($_GET['edit_post']))
    {
        formEditPost();
    }

    if(isset($_GET['sent_edit_post']))
    {
        adminEditPost();
    }

    if(isset($_GET['edited_post']) AND ($_GET['edited_post']))
    {
        echo '<p>Le billet a bien été modifié !</p>';
    }


    if (isset($_GET['delete_comment']))
    {
        adminDeleteComment();
    }

    if(isset($_GET['deleted_comment']) AND ($_GET['deleted_comment']))
    {
        echo '<p>Le commentaire a bien été supprimé !</p>';
    }

//INDEX FRONT
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
            header('Location: back_index.php?comment=' . $_GET['send_comment'] . '&empty=true');
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