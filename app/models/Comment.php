<?php

namespace Models;

class Comment extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'comment';
	
	/**
	 * Count number of comments for each post
	 *
	 * @return array
	 */
	public function count(): array
	{
		$array = array();
		$post = new Post();
		$posts = $post->findAllByPage();
		
		foreach ($posts as $post) {
			$q = $this->db->prepare('SELECT COUNT(id) AS number_of_comments FROM comment WHERE id_post= ? AND approved = 1');
			$q->execute(array($post['id']));
			$comments_number = $q->fetch();
			$array[] = $comments_number;
		}
		return $array;
	}
	
	/**
	 * Return all approved comments for asked post or return all unapproved comments
	 *
	 * @param bool     $approved
	 * @param int|null $id_post
	 *
	 * @return array
	 */
	public function findAllByPost(bool $approved, ?int $id_post = null): array
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
	
	/**
	 * Create new comment, awaiting manual validation
	 *
	 * @param int    $id_post
	 * @param string $pseudo
	 * @param string $text
	 */
	public function insert(int $id_post, string $pseudo, string $text): void
	{
		$q = $this->db->prepare('INSERT INTO comment (id_post, author, text, comment_date, comment_time)
												VALUES (:id_post, :pseudo, :text, NOW(), NOW())');
		$q->execute(compact('id_post', 'pseudo', 'text'));
	}
	
	/**
	 * Validate asked comment for it to be showed in public
	 *
	 * @param int $id
	 *
	 * @return int
	 */
	public function validate(int $id): int
	{
		$q = $this->db->prepare('UPDATE comment SET approved = 1 WHERE id = ?');
		$q->execute(array($id));
		return $q->rowCount();
	}
}