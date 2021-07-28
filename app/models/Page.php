<?php

namespace Models;

class Page extends Model
{
	/**
	 * @return false|float
	 */
	private function count(): float
	{
		$q = $this->db->query('SELECT COUNT(id) AS number FROM post');
		$number = $q->fetch();
		
		$pageNumber = $number['number'] / \Config::NB_POSTS_PER_PAGE;
		
		return ceil($pageNumber);
	}
	
	/**
	 * @return array
	 */
	public function get(): array
	{
		$roundedNumber = $this->count();
		$page = 1;
		
		$array_page = array();
		
		for ($i = 0; $i < $roundedNumber; $i++) {
			$array_page[] = $page;
			$page++;
		}
		return $array_page;
	}
}
