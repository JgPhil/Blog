<!DOCTYPE html>
<?php $this->title = "Article"; ?>
<h1>Mon blog</h1>
<p>En construction</p>
<div class="card">
    <div class="card-body">
        <h2 class="card-title"><?= htmlspecialchars($post->getTitle());?></h2>
        <h3><?= htmlspecialchars($post->getHeading());?></h3>
        <p><?= htmlspecialchars($post->getContent());?></p>
        <p><?= htmlspecialchars($post->getAuthor());?></p>
        <p>Créé le : <?= htmlspecialchars($post->getCreatedAt());?></p>
    </div>
</div>
<br>
<div class="actions">
    <a href="../public/index.php?route=editPost&postId=<?= $post->getId(); ?>">Modifier</a>
</div>
<a href="../public/index.php">Retour à l'accueil</a>
<div id="comments" class="text-left" style="margin-left: 50px">
    <h3>Commentaires</h3>
    <?php
    foreach ($comments as $comment)
    {
        ?>
        <h4><?= htmlspecialchars($comment->getPseudo());?></h4>
        <p><?= htmlspecialchars($comment->getContent());?></p>
        <p>Posté le <?= htmlspecialchars($comment->getCreatedAt());?></p>
        <?php
    }
    ?>
</div>