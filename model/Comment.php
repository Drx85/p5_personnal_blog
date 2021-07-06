<?php

require_once("Manager.php");
require_once("Post.php");

class Comment extends Manager
{
	protected $table = 'comment';
	
    public function count()
    {
        $array = array();
        $post = new Post();
        $blog = $post->findAll();

        while ($display_blog = $blog->fetch())
        {
            $req = $this->db->prepare('SELECT COUNT(*) AS number_of_comments FROM comment WHERE id_post= ?');
            $req->execute(array($display_blog['id']));
            $comments_number = $req->fetch();
            $array[] = $comments_number;
        }
        return $array;
    }

    public function findAll(int $id_post)
    {
        $blog_comments = $this->db->prepare('SELECT id, id_post, author, text_comment, DATE_FORMAT(comment_date, \'%d/%m/%Y\') AS comment_date,
                                      HOUR(comment_time) AS hour_comment_time, MINUTE(comment_time) AS minute_comment_time
				                      FROM comment WHERE id_post = ? ORDER BY ID');
        $blog_comments->execute(array($id_post));
        return $blog_comments;
    }

    public function insert(int $id_post, string $pseudo, string $text_comment)
    {
        $sent_comment = $this->db->prepare('INSERT INTO comment (id_post, author, text_comment, comment_date, comment_time)
												VALUES (:id_post, :author, :text_comment, NOW(), NOW())');
        $sent_comment->execute(array(
            'id_post' => $id_post,
            'author' => $pseudo,
            'text_comment' => $text_comment
        ));
    }
}