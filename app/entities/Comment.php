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
	private $date;
	/**
	 * @var string
	 */
	private $time;
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
	public function getDate(): string
	{
		return $this->date;
	}
	
	/**
	 * @param string $date
	 *
	 * @return Comment
	 */
	public function setDate(string $date): Comment
	{
		$this->date = $date;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getTime(): string
	{
		return $this->time;
	}
	
	/**
	 * @param string $time
	 *
	 * @return Comment
	 */
	public function setTime(string $time): Comment
	{
		$this->time = $time;
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
