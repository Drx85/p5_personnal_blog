<?php

require_once("Manager.php");

class AdminManager extends Manager
{
    public function insertPost()
    {
        $db = $this->dbConnect();
        $sent_post = $db->prepare('INSERT INTO blog_post (title, message, author, post_date, post_time) VALUES (:title, :message, :author, NOW(), NOW())');
        $sent_post->execute(array(
            'title' => $_POST['title'],
            'message' => $_POST['post_content'],
			'author' => $_SESSION['pseudo']
        ));
    }

    public function deletePost()
    {
        $db = $this->dbConnect();
        $q = $db->prepare('DELETE FROM blog_post WHERE id = ?');
        $q->execute(array($_GET['delete_post']));
    }

    public function valuesEditPost()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT title, message, author FROM blog_post WHERE id = ?');
        $req->execute(array($_GET['edit_post']));
        $req = $req->fetch();
        return $req;
    }

    public function editPost()
    {
        $db = $this->dbConnect();
        $edit_post = $db->prepare('UPDATE blog_post SET title = :title, message = :message, author = :author, update_date = NOW() WHERE id = :id');
        $edit_post->execute(array(
            'title' => $_POST['edit_title'],
            'message' => $_POST['edit_post_content'],
            'author' => $_POST['edit_author'],
            'id' => $_GET['sent_edit_post']
        ));
    }

    public function deleteComment()
    {
        $db = $this->dbConnect();
        $q = $db->prepare('DELETE FROM blog_comment WHERE id = ?');
        $q->execute(array($_GET['delete_comment']));
    }
}