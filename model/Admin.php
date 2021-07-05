<?php

require_once("Manager.php");

class Admin extends Manager
{
    public function valuesEditPost()
    {
        $req = $this->db->prepare('SELECT title, message, author FROM post WHERE id = ?');
        $req->execute(array($_GET['edit_post']));
        $req = $req->fetch();
        return $req;
    }
}