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

<a href="../public/index.php">Retour à l'accueil</a>
<div id="comments" class="text-left" style="margin-left: 50px">

<?php

    if ($this->session->get('pseudo'))
    {
        ?>
    <h3>Ajouter un commentaire</h3>
        <?= $this->session->show('add_comment'); ?>
            <form class="form-group" method="post" action="../public/index.php?route=addComment&postId=<?= htmlspecialchars($post->getId()); ?>">
                <div class="form-group">
                    <label for="pseudo">Pseudo</label><br>
                    <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?=$this->session->get('pseudo'); ?> " readonly><br>
                    <?= isset($errors['pseudo']) ? $errors['pseudo'] : ''; ?>
                    <label for="content">Message</label><br>
                    <textarea class="form-control" id="content" name="content"></textarea><br>
                    <?= isset($errors['content']) ? $errors['content'] : ''; ?>
                    <input type="submit" class="btn btn-primary" value="Soumettre" id="submit" name="submit">
                    
                </div>   
            </form>   
<?php
    }
?>   
    <h3>Commentaires</h3>
    <?=$this->session->show('add_comment') ;?>
    <?php
    foreach ($comments as $comment)
    {
        ?>
        <h4><?= htmlspecialchars($comment->getPseudo());?></h4>
        <p><?= htmlspecialchars($comment->getContent());?></p>
        <p>Posté le <?= htmlspecialchars($comment->getCreatedAt());?></p>
        <?php
        if ($this->session->get('role') === 'admin'){
            ?>
        <p><a href="../public/index.php?route=deleteComment&commentId=<?= $comment->getId(); ?>">Supprimer le commentaire</a></p>
        <?php
        }
        
    }
    ?>
    
</div>