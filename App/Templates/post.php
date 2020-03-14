<?php
namespace App\Templates;
use App\Manager\PostManager;
use App\Manager\UserManager;
use App\Model\Post;
use App\Manager\CommentManager;

$p = new PostManager;
$result = $p->getPost(2);

$r = new UserManager;
$author = $r->getAuthor($result['user_id']);

$c = new CommentManager;
$comments = $c->getComments();

?>

<div class="container">

    <h1><?= $result['title'] ?></h1><br>
    <h3><?= $result['heading'] ?></h3><br>
    <p><em><b><?= $author['username']?></b>, le <b><?= $result['creation_date']?>.</b></em><p><br>
    <p><?= $result['content'] ?> </p><br>
    <h5>Commentaires</h5>
    <?php foreach ($comments as $comment) { ?>
        <h6><?=$comment['user_id']?>, le <?=$comment['comment_date']?></h6><br>
        <p>
    <?= $comment['content_comment'];
    }


  ?>
</div>