<?php


namespace Entities;


class Post
{
	/**
	 * @var int
	 */
	private $id;
	/**
	 * @var string
	 */
	private $title;
	/**
	 * @var string
	 */
	private $message;
	/**
	 * @var string
	 */
	private $author;
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
	 * @var string|null
	 */
	private $updateDate;
	/**
	 * @var int
	 */
	private $commentsNb;
	
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
	 * @return Post
	 */
	public function setId(int $id): Post
	{
		$this->id = $id;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}
	
	/**
	 * @param string $title
	 *
	 * @return Post
	 */
	public function setTitle(string $title): Post
	{
		$this->title = $title;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getMessage(): string
	{
		return $this->message;
	}
	
	/**
	 * @param string $message
	 *
	 * @return Post
	 */
	public function setMessage(string $message): Post
	{
		$this->message = $message;
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
	 * @return Post
	 */
	public function setAuthor(string $author): Post
	{
		$this->author = $author;
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
	 * @return Post
	 */
	public function setDate(string $date): Post
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
	 * @return Post
	 */
	public function setTime(string $time): Post
	{
		$this->time = $time;
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
	 * @return Post
	 */
	public function setHour(int $hour): Post
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
	 * @return Post
	 */
	public function setMinute(int $minute): Post
	{
		$this->minute = $minute;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getUpdateDate()
	{
		return $this->updateDate;
	}
	
	/**
	 * @param string $updateDate
	 *
	 * @return Post
	 */
	public function setUpdateDate($updateDate): Post
	{
		$this->updateDate = $updateDate;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getCommentsNb(): int
	{
		return $this->commentsNb;
	}
	
	/**
	 * @param int $commentsNb
	 *
	 * @return Post
	 */
	public function setCommentsNb(int $commentsNb): Post
	{
		$this->commentsNb = $commentsNb;
		return $this;
	}
	
}