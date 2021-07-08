<?php

namespace Models;

class Page extends Model
{
    private function count()
    {
        $q = $this->db->query('SELECT COUNT(id) AS number FROM post');
        $number = $q->fetch();

        $pageNumber = $number['number'] / 5;

        return ceil($pageNumber);
    }

    public function get()
    {
        $roundedNumber = $this->count();
        $page = 1;

        $array_page = array ();

        for ($i=0 ; $i < $roundedNumber ; $i++)
        {
            $array_page[] = $page;
            $page++;
        }
        return $array_page;
    }
}
