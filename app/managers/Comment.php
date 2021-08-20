<?php

namespace Managers;

class Comment extends Manager
{
	/**
	 * @var string
	 */
	protected $table = 'comment';

	/**
	 * Return all approved comments for asked post or return all unapproved comments
	 *
	 * @param bool     $approved
	 * @param int|null $idPost
	 *
	 * @return array
	 */
	public function findAllByPost(bool $approved, ?int $idPost = null): array
	{
		if ($idPost) {
			$sql = "SELECT id, id_post AS idPost, author, text, DATE_FORMAT(comment_date, '%d/%m/%Y') AS date,
                                      HOUR(comment_time) AS hour, MINUTE(comment_time) AS minute
				                      FROM comment WHERE id_post = ? AND approved = ? ORDER BY ID";
			$q = $this->db->prepare($sql);
			$q->execute(array($idPost, $approved));
		} else {
			$sql = "SELECT id, id_post AS idPost, author, text, DATE_FORMAT(comment_date, '%d/%m/%Y') AS date,
                                      HOUR(comment_time) AS hour, MINUTE(comment_time) AS minute
				                      FROM comment WHERE approved = ? ORDER BY ID";
			$q = $this->db->prepare($sql);
			$q->execute(array($approved));
		}
		$comments = $q->fetchAll();
		$arrayComments = [];
		foreach ($comments as $comment) {
			$arrayComments[] = new \Entities\Comment($comment);
		}
		return $arrayComments;
	}
	
	/**
	 * Create new comment, awaiting manual validation
	 *
	 * @param \Entities\Comment $comment
	 */
	public function insert(\Entities\Comment $comment): void
	{
		$q = $this->db->prepare('INSERT INTO comment (id_post, author, text, comment_date, comment_time)
												VALUES (:id_post, :author, :text, :c_date, :c_time)');
		$q->bindValue(':id_post', $comment->getIdPost());
		$q->bindValue(':author', $comment->getAuthor());
		$q->bindValue(':text', $comment->getText());
		$q->bindValue(':c_date', $comment->getDate());
		$q->bindValue(':c_time', $comment->getTime());
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