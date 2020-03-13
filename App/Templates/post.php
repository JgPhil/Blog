<?php
namespace App\Templates;
use App\Manager\PostManager;
use App\Model\Post;


$p = new PostManager;
$result= $p->getPost(2);


?>

<div class="container">

    <h1><?= $result['title'] ?></h1><br>
    <h3><?= $result['heading'] ?></h3><br>
    <p><em><b><?= $result['user_id']?></b>, le <b><?= $result['creation_date']?>.</b></em><p><br>
    <p><?= $result['content'] ?> </p>
  
</div>