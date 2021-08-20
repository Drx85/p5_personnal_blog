<?php

namespace Managers;

use PDO;

class Post extends Manager
{
	protected $table = 'post';
	
	/**
	 * Return all posts by page, classed by recent date
	 *
	 * @return array
	 */
	public function findAllByPage(): array
	{
		$limitPage = $this->getLIMIT((int)filter_input(INPUT_GET, 'page'));
		
		$q = $this->db->prepare('SELECT id, title, message, author, comments_nb AS commentsNb, DATE_FORMAT(post_date, \'%d/%m/%Y\') AS date,
                                   HOUR(post_time) AS hour,
                                   MINUTE(post_time) AS minute,
                                   DATE_FORMAT(update_date, \'%d/%m/%Y\') AS updateDate
				                   FROM post ORDER BY ID DESC LIMIT :limit_page, :nb_posts');
		
		$q->bindValue('limit_page', $limitPage, PDO::PARAM_INT);
		$q->bindValue('nb_posts', \Config::NB_POSTS_PER_PAGE, PDO::PARAM_INT);
		$q->execute();
		$posts = $q->fetchAll();
		$arrayPosts = [];
		foreach ($posts as $post) {
			$arrayPosts[] = new \Entities\Post($post);
		}
		return $arrayPosts;
	}
	
	/**
	 * Return one asked post
	 *
	 * @param \Entities\Post $post
	 *
	 * @return \Entities\Post
	 */
	public function find(\Entities\Post $post): \Entities\Post
	{
		$q = $this->db->prepare("SELECT id, title, message, author, DATE_FORMAT(post_date, '%d/%m/%Y') AS date,
                                   HOUR(post_time) AS hour,
                                   MINUTE(post_time) AS minute,
                                   DATE_FORMAT(update_date, '%d/%m/%Y') AS updateDate FROM post WHERE id = :id");
		$q->bindValue(':id', $post->getId());
		$q->execute();
		$pdoPost = $q->fetch();
		$title = $pdoPost['title'];
		$message = $pdoPost['message'];
		$author = $pdoPost['author'];
		$date = $pdoPost['date'];
		$hour = $pdoPost['hour'];
		$minute = $pdoPost['minute'];
		$updateDate = $pdoPost['update_date'];
		$post->setTitle($title)
			->setMessage($message)
			->setAuthor($author)
			->setDate($date)
			->setHour($hour)
			->setMinute($minute)
			->setUpdateDate($updateDate);
		return $post;
	}
	
	/**
	 * Determine and return correct LIMIT value for asked page
	 *
	 * @param int $page
	 *
	 * @return int
	 */
	private function getLIMIT(int $page): int
	{
		$limitPage = 0;
		
		for ($i = 0; $i < $page - 1; $i++) {
			$limitPage = $limitPage + \Config::NB_POSTS_PER_PAGE;
		}
		return $limitPage;
	}
	
	/**
	 * Create new post
	 *
	 * @param \Entities\Post $post
	 * @param string         $pseudo
	 *
	 * @return bool
	 */
	public function insert(\Entities\Post $post, string $pseudo): bool
	{
		$q = $this->db->prepare('INSERT INTO post (title, message, author, post_date, post_time) VALUES (:title, :message, :pseudo, :p_date, :p_time)');
		$q->bindValue(':title', $post->getTitle());
		$q->bindValue(':message', $post->getMessage());
		$q->bindValue(':pseudo', $pseudo);
		$q->bindValue(':p_date', $post->getDate());
		$q->bindValue(':p_time', $post->getTime());
		return $q->execute();
	}
	
	/**
	 * Return values to be displayed in asked edit post form
	 *
	 * @param \Entities\Post $post
	 *
	 * @return \Entities\Post
	 */
	public function getEditValues(\Entities\Post $post): \Entities\Post
	{
		$q = $this->db->prepare('SELECT id, title, message, author FROM post WHERE id = :id');
		$q->bindValue(':id', $post->getId());
		$q->execute();
		$pdoPost = $q->fetch();
		$title = $pdoPost['title'];
		$message = $pdoPost['message'];
		$author = $pdoPost['author'];
		$post->setTitle($title)
			->setMessage($message)
			->setAuthor($author);
		return $post;
	}
	
	/**
	 * Update asked post
	 *
	 * @param \Entities\Post $post
	 *
	 * @return bool
	 */
	public function edit(\Entities\Post $post): bool
	{
		$q = $this->db->prepare('UPDATE post SET title = :title, message = :message, author = :author, update_date = NOW() WHERE id = :id');
		$q->bindValue(':title', $post->getTitle());
		$q->bindValue(':message', $post->getMessage());
		$q->bindValue(':author', $post->getAuthor());
		$q->bindValue(':id', $post->getId());
		return $q->execute();
	}
}