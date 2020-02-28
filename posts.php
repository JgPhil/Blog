<?php
require_once 'db/db.php';
require '../elements/header.php';
$query = $pdo->query('SELECT * FROM posts');
$posts = $query->fetchAll(PDO::FETCH_OBJ);

 require '../elements/footer.php';

 ?>
 <ul>
    <?php foreach ($posts as $post): ?>
    <li><?= $post->title ?> </li>
    <?php endforeach ?>
 </ul>

