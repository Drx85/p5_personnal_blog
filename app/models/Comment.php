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
            $q = $this->db->prepare('SELECT COUNT(id) AS number_of_comments FROM comment WHERE id_post= ? AND approved = 1');
            $q->execute(array($display_blog['id']));
            $comments_number = $q->fetch();
            $array[] = $comments_number;
        }
        return $array;
    }

    public function findAll(bool $approved, ?int $id_post = null)
    {
    	if ($id_post) {
    		$sql = "SELECT id, id_post, author, text, DATE_FORMAT(comment_date, '%d/%m/%Y') AS c_date,
                                      HOUR(comment_time) AS c_hour, MINUTE(comment_time) AS c_minute
				                      FROM comment WHERE id_post = ? AND approved = ? ORDER BY ID";
			$q = $this->db->prepare($sql);
			$q->execute(array($id_post, $approved));
		} else {
			$sql = "SELECT id, id_post, author, text, DATE_FORMAT(comment_date, '%d/%m/%Y') AS c_date,
                                      HOUR(comment_time) AS c_hour, MINUTE(comment_time) AS c_minute
				                      FROM comment WHERE approved = ? ORDER BY ID";
			$q = $this->db->prepare($sql);
			$q->execute(array($approved));
		}
    	
        return $q->fetchAll();
    }

    public function insert(int $id_post, string $pseudo, string $text)
    {
        $q = $this->db->prepare('INSERT INTO comment (id_post, author, text, comment_date, comment_time)
												VALUES (:id_post, :pseudo, :text, NOW(), NOW())');
        $q->execute(compact('id_post', 'pseudo', 'text'));
    }
	
	public function validate($id)
	{
		$q = $this->db->prepare('UPDATE comment SET approved = 1 WHERE id = ?');
		$q->execute(array($id));
	}
}