<?php
namespace App\Controller;

use App\Manager\PostManager;
use App\Manager\UserManager;
use App\Model\Post;
use App\Manager\CommentManager;



class PostController
{
    public function render() {

        $p = new PostManager;
        $result = $p->getPost(2); 
        
        $r = new UserManager;
        var_dump($result);
        
        $author = $r->getAuthor($result->user_id());
        
        $c = new CommentManager;
        $comments = $c->getComments();
        
        require '../App/Templates/post.php';
}
}

   