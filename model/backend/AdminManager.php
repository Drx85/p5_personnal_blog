<?php

require_once(__DIR__ . '/../frontend/Manager.php');

class AdminManager extends Manager
{
    public function insertPost()
    {
        $db = $this->dbConnect();
        $sent_post = $db->prepare('INSERT INTO blog_posts (title, message, post_date, post_time) VALUES (:title, :message, NOW(), NOW())');
        $sent_post->execute(array(
            'title' => $_POST['title'],
            'message' => $_POST['post_content'],
        ));
    }

    public function deletePost()
    {
        $db = $this->dbConnect();
        $db->exec('DELETE FROM blog_posts WHERE id = ' . $_GET['delete_post'] . ' ');
    }

    public function valuesEditPost()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT title, message FROM blog_posts WHERE id =' . $_GET['edit_post'] . ' ');
        $req = $req->fetch();
        return $req;
    }

    public function editPost()
    {
        $db = $this->dbConnect();
        $edit_post = $db->prepare('UPDATE blog_posts SET title = :title, message = :message WHERE id = :id');

        $edit_post->execute(array(
            'title' => $_POST['edit_title'],
            'message' => $_POST['edit_post_content'],
            'id' => $_GET['sent_edit_post']
        ));
    }

    public function deleteComment()
    {
        $db = $this->dbConnect();
        $db->exec('DELETE FROM blog_comments WHERE id = ' . $_GET['delete_comment'] . ' ');
    }
}