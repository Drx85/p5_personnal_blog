<?php

namespace Models;

class Page extends Model
{
	/**
	 * Count all posts, then calculate and return how many pages are needed, depending of wanted NB_POSTS_PER_PAGE set in Config file
	 *
	 * @return float
	 */
	private function count(): float
	{
		$q = $this->db->query('SELECT COUNT(id) AS number FROM post');
		$number = $q->fetch();
		
		$pageNumber = $number['number'] / \Config::NB_POSTS_PER_PAGE;
		
		return ceil($pageNumber);
	}
	
	/**
	 * Create and return coherent array page, depending number of pages needed
	 *
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
