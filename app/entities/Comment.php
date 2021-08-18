<?php


namespace Entities;


class Comment
{
	/**
	 * @var int
	 */
	private $id;
	/**
	 * @var int
	 */
	private $id_post;
	/**
	 * @var string
	 */
	private $author;
	/**
	 * @var string
	 */
	private $text;
	/**
	 * @var string
	 */
	private $commentDate;
	/**
	 * @var string
	 */
	private $commentTime;
	/**
	 * @var int
	 */
	private $hour;
	/**
	 * @var int
	 */
	private $minute;
	/**
	 * @var int
	 */
	private $approved;
	
	public function hydrate(array $values)
	{
		foreach ($values as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (method_exists($this, $method)) $this->$method($value);
		}
	}
	
	public function __construct($values = [])
	{
		if (!empty($values)) $this->hydrate($values);
	}
	
	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}
	
	/**
	 * @param int $id
	 *
	 * @return Comment
	 */
	public function setId(int $id): Comment
	{
		$this->id = $id;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getIdPost(): int
	{
		return $this->id_post;
	}
	
	/**
	 * @param int $id_post
	 *
	 * @return Comment
	 */
	public function setIdPost(int $id_post): Comment
	{
		$this->id_post = $id_post;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getAuthor(): string
	{
		return $this->author;
	}
	
	/**
	 * @param string $author
	 *
	 * @return Comment
	 */
	public function setAuthor(string $author): Comment
	{
		$this->author = $author;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getText(): string
	{
		return $this->text;
	}
	
	/**
	 * @param string $text
	 *
	 * @return Comment
	 */
	public function setText(string $text): Comment
	{
		$this->text = $text;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getCommentDate(): string
	{
		return $this->commentDate;
	}
	
	/**
	 * @param string $commentDate
	 *
	 * @return Comment
	 */
	public function setCommentDate(string $commentDate): Comment
	{
		$this->commentDate = $commentDate;
		return $this;
	}
	
	/**
	 * @param string $commentTime
	 *
	 * @return Comment
	 */
	public function setCommentTime(string $commentTime): Comment
	{
		$this->commentTime = $commentTime;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getApproved(): int
	{
		return $this->approved;
	}
	
	/**
	 * @param int $approved
	 *
	 * @return Comment
	 */
	public function setApproved(int $approved): Comment
	{
		$this->approved = $approved;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getHour(): int
	{
		return $this->hour;
	}
	
	/**
	 * @param int $hour
	 *
	 * @return Comment
	 */
	public function setHour(int $hour): Comment
	{
		$this->hour = $hour;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getMinute(): int
	{
		return $this->minute;
	}
	
	/**
	 * @param int $minute
	 *
	 * @return Comment
	 */
	public function setMinute(int $minute): Comment
	{
		$this->minute = $minute;
		return $this;
	}
}
