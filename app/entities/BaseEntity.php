<?php


namespace Entities;


abstract class BaseEntity
{
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
}