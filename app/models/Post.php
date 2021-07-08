<?php

namespace Models;

use PDO;

class Post extends Model
{
	protected $table = 'post';
	
    public function findAll()
    {
        $limit_page = $this->getLIMIT($_GET['page']);

        $q = $this->db->prepare('SELECT id, title, message, author, DATE_FORMAT(post_date, \'%d/%m/%Y\') AS post_date,
                                   HOUR(post_time) AS hour_post_time, 
                                   MINUTE(post_time) AS minute_post_time,
                                   DATE_FORMAT(update_date, \'%d/%m/%Y\') AS update_date
				                   FROM post ORDER BY ID DESC LIMIT :limit_page, 5');

        $q->bindValue('limit_page', $limit_page, PDO::PARAM_INT);
        $q->execute();
        return $q->fetchAll();
    }
	
	private function getLIMIT($page)
	{
		$limit_page = 0;
		
		for ($i = 0; $i < $page - 1; $i++) {
			$limit_page = $limit_page + 5;
		}
		return $limit_page;
	}
	
	public function insert(string $title, string $message, string $pseudo)
	{
		$sent_post = $this->db->prepare('INSERT INTO post (title, message, author, post_date, post_time) VALUES (:title, :message, :pseudo, NOW(), NOW())');
		$sent_post->execute(compact('title', 'message', 'pseudo'));
	}
	
	public function edit(string $title, string $message, string $author, int $id)
	{
		$edit_post = $this->db->prepare('UPDATE post SET title = :title, message = :message, author = :author, update_date = NOW() WHERE id = :id');
		$edit_post->execute(compact('title', 'message', 'author', 'id'));
	}
}