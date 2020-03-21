<?php

namespace App\Manager;


class PostManager extends Db
{
private $db;

    public function getPost($post_id)
    {
        $db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM posts WHERE post_id =:post_id');
		$req->bindValue(':post_id', $post_id);
		$req->execute();

		$post = $req->fetch(\PDO::FETCH_ASSOC);
		return $post;
	}
	
	



}