<?php

namespace App\Manager;


class CommentManager extends Db
{
    private $db;

    public function getComments() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM comments JOIN user ON user.user_id = comments.user_id' );
        $req->execute();
        $comments = $req->fetchAll();
        
        return $comments;
    }
}

