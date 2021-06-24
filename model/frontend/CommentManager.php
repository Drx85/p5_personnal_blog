<?php

require_once("Manager.php");
require_once("PostManager.php");

class CommentManager extends Manager
{
    public function countComments()
    {
        $array = array();
        $postManager = new PostManager();
        $blog = $postManager->listPosts();

        while ($display_blog = $blog->fetch())
        {
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT COUNT(*) AS number_of_comments FROM blog_comments WHERE id_post= ?');
            $req->execute(array($display_blog['id']));
            $comments_number = $req->fetch();
            $array[] = $comments_number;
        }
        return $array;
    }

    public function listComments()
    {
        $db = $this->dbConnect();
        $blog_comments = $db->prepare('SELECT id, id_post, author, text_comment, DATE_FORMAT(comment_date, \'%d/%m/%Y\') AS comment_date, 
                                      HOUR(comment_time) AS hour_comment_time, MINUTE(comment_time) AS minute_comment_time
				                      FROM blog_comments WHERE id_post = ? ORDER BY ID');
        $blog_comments->execute(array($_GET['comment']));
        return $blog_comments;
    }

    public function insertComment()
    {
        $db = $this->dbConnect();
        $sent_comment = $db->prepare('INSERT INTO blog_comments (id_post, author, text_comment, comment_date, comment_time) VALUES (:id_post, :author, :text_comment, NOW(), NOW())');
        $sent_comment->execute(array(
            'id_post' => $_GET['send_comment'],
            'author' => $_POST['pseudo'],
            'text_comment' => $_POST['user_comment']
        ));
    }
}