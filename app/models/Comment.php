<?php

namespace Models;

class Comment extends Model
{
	protected $table = 'comment';
	
    public function count()
    {
        $array = array();
        $post = new Post();
        $blog = $post->findAll();

        foreach ($blog as $display_blog)
        {
            $q = $this->db->prepare('SELECT COUNT(id) AS number_of_comments FROM comment WHERE id_post= ?');
            $q->execute(array($display_blog['id']));
            $comments_number = $q->fetch();
            $array[] = $comments_number;
        }
        return $array;
    }

    public function findAll(int $id_post)
    {
        $q = $this->db->prepare('SELECT id, id_post, author, text_comment, DATE_FORMAT(comment_date, \'%d/%m/%Y\') AS comment_date,
                                      HOUR(comment_time) AS hour_comment_time, MINUTE(comment_time) AS minute_comment_time
				                      FROM comment WHERE id_post = ? ORDER BY ID');
        return $q->execute(array($id_post));
    }

    public function insert(int $id_post, string $pseudo, string $text_comment)
    {
        $q = $this->db->prepare('INSERT INTO comment (id_post, author, text_comment, comment_date, comment_time)
												VALUES (:id_post, :pseudo, :text_comment, NOW(), NOW())');
        $q->execute(compact('id_post', 'pseudo', 'text_comment'));
    }
}