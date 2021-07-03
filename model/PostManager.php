<?php

require_once("Manager.php");

class PostManager extends Manager
{
    public function listPosts()
    {
        $limit_page = $this->getLIMIT();

        $blog_post = $this->db->prepare('SELECT id, title, message, author, DATE_FORMAT(post_date, \'%d/%m/%Y\') AS post_date,
                                   HOUR(post_time) AS hour_post_time, 
                                   MINUTE(post_time) AS minute_poste_time,
                                   DATE_FORMAT(update_date, \'%d/%m/%Y\') AS update_date
				                   FROM blog_post ORDER BY ID DESC LIMIT :limit_page, 5');

        $blog_post->bindValue('limit_page', $limit_page, PDO::PARAM_INT);
        $blog_post->execute();

        return $blog_post;
    }

    public function linkedPost()
    {
        $post = $this->db->prepare('SELECT title, message, author, DATE_FORMAT(post_date, \'%d/%m/%Y\') AS post_date,
                                   HOUR(post_time) AS hour_post_time, 
                                   MINUTE(post_time) AS minute_poste_time,
                                   DATE_FORMAT(update_date, \'%d/%m/%Y\') AS update_date
			                       FROM blog_post WHERE id = ?');
        $post->execute(array($_GET['comment']));
        $post = $post->fetch();
        return $post;
    }
	
	private function getLIMIT()
	{
		$limit_page = 0;
		
		for ($i = 0; $i < $_GET['page'] - 1; $i++) {
			$limit_page = $limit_page + 5;
		}
		return $limit_page;
	}
}