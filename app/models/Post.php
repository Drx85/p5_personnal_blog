<?php

namespace Models;

use PDO;

class Post extends Model
{
	protected $table = 'post';
	
	/**
	 * @return array
	 */
	public function findAll(): array
	{
		$limit_page = $this->getLIMIT((int)filter_input(INPUT_GET, 'page'));
		
		$q = $this->db->prepare('SELECT id, title, message, author, DATE_FORMAT(post_date, \'%d/%m/%Y\') AS post_date,
                                   HOUR(post_time) AS hour_post_time, 
                                   MINUTE(post_time) AS minute_post_time,
                                   DATE_FORMAT(update_date, \'%d/%m/%Y\') AS update_date
				                   FROM post ORDER BY ID DESC LIMIT :limit_page, :nb_posts');
		
		$q->bindValue('limit_page', $limit_page, PDO::PARAM_INT);
		$q->bindValue('nb_posts', \Config::NB_POSTS_PER_PAGE, PDO::PARAM_INT);
		$q->execute();
		return $q->fetchAll();
	}
	
	/**
	 * @param int $id
	 *
	 * @return mixed
	 */
	public function find(int $id): mixed
	{
		$q = $this->db->prepare("SELECT id, title, message, author, DATE_FORMAT(post_date, '%d/%m/%Y') AS date,
                                   HOUR(post_time) AS hour,
                                   MINUTE(post_time) AS minute,
                                   DATE_FORMAT(update_date, '%d/%m/%Y') AS update_date FROM post WHERE id = ?");
		$q->execute(array($id));
		return $q->fetch();
	}
	
	/**
	 * @param int $page
	 *
	 * @return int
	 */
	private function getLIMIT(int $page): int
	{
		$limit_page = 0;
		
		for ($i = 0; $i < $page - 1; $i++) {
			$limit_page = $limit_page + \Config::NB_POSTS_PER_PAGE;
		}
		return $limit_page;
	}
	
	/**
	 * @param string $title
	 * @param string $message
	 * @param string $pseudo
	 *
	 * @return bool
	 */
	public function insert(string $title, string $message, string $pseudo): bool
	{
		$q = $this->db->prepare('INSERT INTO post (title, message, author, post_date, post_time) VALUES (:title, :message, :pseudo, NOW(), NOW())');
		return $q->execute(compact('title', 'message', 'pseudo'));
	}
	
	/**
	 * @param int $id
	 *
	 * @return mixed
	 */
	public function getEditValues(int $id): mixed
	{
		$q = $this->db->prepare('SELECT id, title, message, author FROM post WHERE id = ?');
		$q->execute(array($id));
		return $q->fetch();
	}
	
	/**
	 * @param string $title
	 * @param string $message
	 * @param string $author
	 * @param int    $id
	 *
	 * @return bool
	 */
	public function edit(string $title, string $message, string $author, int $id): bool
	{
		$q = $this->db->prepare('UPDATE post SET title = :title, message = :message, author = :author, update_date = NOW() WHERE id = :id');
		return $q->execute(compact('title', 'message', 'author', 'id'));
	}
}