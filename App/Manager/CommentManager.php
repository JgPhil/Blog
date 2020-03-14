<?php

namespace App\Manager;

class CommentManager extends Db
{
    private $db;

    public function getComments() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM comments');
        $req->execute();
        $comments = $req->fetchAll();
        
        return $comments;
    }
}