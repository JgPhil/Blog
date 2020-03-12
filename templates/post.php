<?php
require '../vendor/autoload.php';
use App\Model\Manager\PostManager;

$p = new PostManager;
$p = $this->getPost(1);

?>

<div class="container">

    <h1>un post</h1>
    <?= $p ?>
</div>