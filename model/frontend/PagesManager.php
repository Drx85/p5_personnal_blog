<?php

require_once("Manager.php");

class PagesManager extends Manager
{
    public function countPages()
    {
        $db = $this->dbConnect();
        $nb = $db->query('SELECT COUNT(*) AS lines_number FROM blog_posts');

        $count_lines_number = $nb->fetch();

        $page_number = $count_lines_number['lines_number'] / 5;

        return ceil($page_number);
    }

    public function getPages()
    {
        $rounded_page_number = $this->countPages();
        $page = 1;

        $array_page = array ();

        for ($i=0 ; $i < $rounded_page_number ; $i++)
        {
            $array_page[] = $page;
            $page++;
        }
        return $array_page;
    }
}