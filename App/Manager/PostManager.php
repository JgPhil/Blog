<?php

namespace App\Manager;
use App\Model\Post;

class PostManager extends Db
{
private $db;

    public function getPost($post_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT post_id, user_id, title, content, heading DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = :post_id');
        $req = bindValue(':post_id, $post_id');
        $req->execute();
        $post = $req->fetch();

        return $post;
    }



}