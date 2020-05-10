<?php $this->title = "Inscription"; ?>


<!-- page title -->
<section class="page-title bg-primary position-relative">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="text-white font-tertiary"><?= "Commentaires de l'article : " . htmlentities($comments[array_key_first($comments)]->getPostObj()->getTitle()); ?></h2>
            </div>
        </div>
    </div>
    <!-- background shapes -->
    <img src="images/illustrations/page-title.png" alt="illustrations" class="bg-shape-1 w-100">
    <img src="images/illustrations/leaf-pink-round.png" alt="illustrations" class="bg-shape-2">
    <img src="images/illustrations/dots-cyan.png" alt="illustrations" class="bg-shape-3">
    <img src="images/illustrations/leaf-orange.png" alt="illustrations" class="bg-shape-4">
    <img src="images/illustrations/leaf-yellow.png" alt="illustrations" class="bg-shape-5">
    <img src="images/illustrations/dots-group-cyan.png" alt="illustrations" class="bg-shape-6">
    <img src="images/illustrations/leaf-cyan-lg.png" alt="illustrations" class="bg-shape-7">
</section>

<div class="section" data-background="images/backgrounds/bg-dots.png">

    <div class="col-lg-8 mx-auto">
        <div>
            <p><a href="../public/index.php?route=administration"><i class="fas fa-long-arrow-alt-left"></i> Retour à l'administration</a></p>
        </div>
    </div>
</div>
<?php

if (!empty($comments)) {
    foreach ($comments as $comment) {
?>
        <div class="container text-center mb-20">
            <div class="col-lg-12">
                <h5 class="title">Posté le <?= htmlentities($comment->getCreatedAt()); ?> par <?= htmlentities($comment->getUser()->getPseudo()); ?></h5>
                <p><?= htmlentities($comment->getContent()); ?></p>
                <p><a href="../public/index.php?route=hideComment&commentId=<?= htmlentities($comment->getId()); ?>" onclick="return confirm('Vous allez supprimer définitivement ce message. êtes-vous certain de vouloir faire ça ?  ( Irréverssible !!)')">Supprimer le commentaire</a></p>
                <?php
                if ($comment->getValidate() === "0") {
                ?>
                    <p><a href="../public/index.php?route=validateComment&commentId=<?= htmlentities($comment->getId()); ?>">Valider</a></p>
            </div>
        </div>
    <?php
                }
    ?>

    </div>
<?php
    }
}
?>

</div>
</div>