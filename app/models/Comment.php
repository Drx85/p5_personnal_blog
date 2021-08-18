<?php

namespace Models;

class Comment extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'comment';

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
		$array_comments = [];
		$k = 0;
		foreach ($comments as $comment) {
			$id = $comment['id'];
			$id_post = $comment['id_post'];
			$author = $comment['author'];
			$text = $comment['text'];
			$date = $comment['c_date'];
			$hour = $comment['c_hour'];
			$minute = $comment['minute'];

			$comment = new \Entities\Comment();
			$comment->setId($id)
				->setIdPost($id_post)
				->setAuthor($author)
				->setText($text)
				->setCommentDate($date)
				->setHour($hour)
				->setMinute($minute);
			$array_comments[$k] = $comment;
			$k++;
		}
		return $array_comments;
	}
	
	/**
	 * Create new comment, awaiting manual validation
	 *
	 * @param \Entities\Comment $comment
	 */
	public function insert(\Entities\Comment $comment): void
	{
		$q = $this->db->prepare('INSERT INTO comment (id_post, author, text, comment_date, comment_time)
												VALUES (:id_post, :author, :text, :comment_date, :comment_time)');
		$q->bindValue(':id_post', $comment->getIdPost());
		$q->bindValue(':author', $comment->getAuthor());
		$q->bindValue(':text', $comment->getText());
		$q->bindValue(':comment_date', $comment->getCommentDate());
		$q->bindValue(':comment_time', $comment->getCommentTime());
		$q->execute();
	}
	
	/**
	 * Validate asked comment for it to be showed in public
	 *
	 * @param \Entities\Comment $comment
	 *
	 * @return int
	 */
	public function validate(\Entities\Comment $comment): int
	{
		$q = $this->db->prepare('UPDATE comment SET approved = 1 WHERE id = :id');
		$q->bindvalue(':id', $comment->getId());
		$q->execute();
		
		$q = $this->db->prepare('UPDATE post as p
											JOIN comment as c ON c.id_post = p.id
											SET p.comments_nb = p.comments_nb + 1
											WHERE c.id = :id');
		$q->bindvalue(':id', $comment->getId());
		$q->execute();
		return $q->rowCount();
	}
}