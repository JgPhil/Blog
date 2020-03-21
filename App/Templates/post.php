
<?php require '../elements/header.php';?>
<div class="container">

    <h1><?= $result['title'] ?></h1><br>
    <h3><?= $result['heading'] ?></h3><br>
        <h4><em><b><?= $author['username']?></b>, le <b><?= $result['creation_date']?>.</b></em><h4><br>
        <p><?= $result['content'] ?> </p><br>

        
    
    <h3>Commentaires</h3><br>
    <?php foreach ($comments as $comment) { ?>
            <h5><em><b><?=$comment['username']?></b>, le <b><?=$comment['comment_date']?></em></b></h5>
            <p><?= $comment['comment_content'];
                }
    ?>

  
</div>

<?php require '../elements/footer.php';?>