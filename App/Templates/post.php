

<div class="container">

    <h1><?= $result['title'] ?></h1><br>
    <h3><?= $result['heading'] ?></h3><br>
        <p><em><b><?= $author['username']?></b>, le <b><?= $result['creation_date']?>.</b></em><p><br>
        <p><?= $result['content'] ?> </p><br>
    
    <h5>Commentaires</h5><br>
    <?php foreach ($comments as $comment) { ?>
        <h6><em><b><?=$comment['user_id']?></b>, le <b><?=$comment['comment_date']?></em></b></h6>
        <p>
    <?= $comment['content_comment'];
    }


  ?>
</div>