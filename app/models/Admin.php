<?php

namespace Models;

class Admin extends Model
{
    public function valuesEditPost($id)
    {
        $q = $this->db->prepare('SELECT title, message, author FROM post WHERE id = ?');
        $q->execute(array($id));
        return $q->fetch();
    }
}