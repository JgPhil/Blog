<?php

namespace App\Manager;
use App\Model\Post;

class PostManager extends Db
{
private $db;

    public function getPost($post_id)
    {
        $db = $this->dbConnect();
		$req = $db->prepare('SELECT post_id, user_id, title, heading, content, creation_date FROM posts WHERE post_id =:post_id');
		$req->bindValue(':post_id', $post_id);
		$req->execute();

		//$req->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, 'App\Model\Post');
		$post = $req->fetch();
		return $post;
    }



}