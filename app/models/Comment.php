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
        $q = $this->db->prepare('SELECT id, id_post, author, text, DATE_FORMAT(comment_date, \'%d/%m/%Y\') AS c_date,
                                      HOUR(comment_time) AS c_hour, MINUTE(comment_time) AS c_minute
				                      FROM comment WHERE id_post = ? ORDER BY ID');
        $q->execute(array($id_post));
        return $q->fetchAll();
    }

    public function insert(int $id_post, string $pseudo, string $text)
    {
        $q = $this->db->prepare('INSERT INTO comment (id_post, author, text, comment_date, comment_time)
												VALUES (:id_post, :pseudo, :text, NOW(), NOW())');
        $q->execute(compact('id_post', 'pseudo', 'text'));
    }
}