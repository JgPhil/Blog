<?php

namespace App\Manager;
use App\Model\Post;

class PostManager extends Db
{
private $db;

    public function getPost($post_id)
    {
        $db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM posts WHERE post_id =:post_id');
		$req->bindValue(':post_id', $post_id);
		$req->execute();

		$p = $req->fetch(\PDO::FETCH_ASSOC);
		
		$post = new Post($p);
		var_dump($post);
		return $post;
	}
	
	
	



}