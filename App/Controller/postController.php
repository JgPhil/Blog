<?php
namespace App\Controller;

use App\Manager\PostManager;
use App\Manager\UserManager;
use App\Model\Post;
use App\Manager\CommentManager;

$p = new PostManager;
$result = $p->getPost(1);

$r = new UserManager;
$author = $r->getAuthor($result['user_id']);

$c = new CommentManager;
$comments = $c->getComments();


class PostController
{
    public function render() {

        $p = new PostManager;
        $result = $p->getPost(1);

        $r = new UserManager;
        $author = $r->getAuthor($result['user_id']);

        $c = new CommentManager;
        $comments = $c->getComments();
        
        require '../App/Templates/post.php';
}
}

   