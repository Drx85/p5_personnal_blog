<?php

namespace Models;

class Admin extends Model
{
    public function valuesEditPost($id)
    {
        $req = $this->db->prepare('SELECT title, message, author FROM post WHERE id = ?');
        $req->execute(array($id));
        $req = $req->fetch();
        return $req;
    }
}