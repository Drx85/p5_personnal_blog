<?php


namespace Entities;


class Mail
{
	/**
	 * @var string
	 */
	private $surname;
	/**
	 * @var string
	 */
	private $name;
	/**
	 * @var string
	 */
	private $email;
	/**
	 * @var string
	 */
	private $message;
	
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
	 * @return string
	 */
	public function getSurname(): string
	{
		return $this->surname;
	}
	
	/**
	 * @param string $surname
	 *
	 * @return Mail
	 */
	public function setSurname(string $surname): Mail
	{
		$this->surname = $surname;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}
	
	/**
	 * @param string $name
	 *
	 * @return Mail
	 */
	public function setName(string $name): Mail
	{
		$this->name = $name;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}
	
	/**
	 * @param string $email
	 *
	 * @return Mail
	 */
	public function setEmail(string $email): Mail
	{
		$this->email = $email;
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
	 * @return Mail
	 */
	public function setMessage(string $message): Mail
	{
		$this->message = $message;
		return $this;
	}
}