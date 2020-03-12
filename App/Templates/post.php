<?php
namespace App\Templates;
use App\Manager\PostManager;



$p = new PostManager;
$result= $p->getPost(1);
var_dump($result);
?>

<div class="container">

    <h1>un post</h1>
  
</div>