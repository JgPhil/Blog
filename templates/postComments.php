<?php $this->title = "Commentaire de l'article"; ?>


<!-- page title -->
<section class="page-title bg-primary position-relative">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="text-white font-tertiary"><?= "Commentaires de l'article : " . htmlentities($comments[array_key_first($comments)]->getPostObj()->getTitle()); ?></h2>
            </div>
        </div>
    </div>
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
            <div class="col-lg-10 text-center bg-light border mt-2 mb-2">
                <div class="row text-center mt-2">
                    <h5 class="col-lg-4 title my-2">Posté le <?= htmlentities($comment->getCreatedAt()); ?> par <?= htmlentities($comment->getUser()->getPseudo()); ?></h5>
                    <div class="col-lg-4">
                        <p><?= $comment->getContent(); ?></p>
                    </div>
                    <div class="profile-userpic col-lg-4">
                        <?php $userPicture = $comment->getUser()->getPicture(); ?>
                        <img height="80" src=<?= isset($userPicture) ? USER_PICTURE . $userPicture->getName() : USER_AVATAR ?> class="img-responsive" alt="<?="Une image de ".htmlentities($comment->getUser()->getPseudo())?>">
                    </div>
                </div>
                <div class="mb-4"><a class="btn btn-danger btn-xs mr-2" href="../public/index.php?route=hideComment&commentId=<?= htmlentities($comment->getId()); ?>" onclick="return confirm('Voulez-vous mettre ce commentaire à la corbeille?  ( Irréverssible !!)')">Supprimer </a>
                    <?php
                    if ($comment->getValidate() === "0") {
                    ?>
                        <a class="btn btn-primary btn-xs" href="../public/index.php?route=validateComment&commentId=<?= htmlentities($comment->getId()); ?>">Valider</a>
                </div>
            </div>
        <?php
                    }
        ?>
        </div>


        </div>
<?php
    }
}
?>


</div>