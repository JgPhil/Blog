
<h2>Commentaires de l'article : <?= htmlspecialchars($comments[array_key_first($comments)]->getPostObj()->getTitle());?></h2>
<a href="../public/index.php?route=administration">Retour</a>
<?php
        foreach ($comments as $comment) {
            ?>  
            <div class="card">
                <div class="card-body"><h5>Posté le <?= htmlspecialchars($comment->getCreatedAt());?> par <?= htmlspecialchars($comment->getPseudo());?></h5>
                <p><?= htmlspecialchars($comment->getContent());?></p>
                <p><a href="../public/index.php?route=deleteComment&commentId=<?= $comment->getId(); ?>">Supprimer le commentaire</a></p>
                <?php
                if ($comment->getValidate() === null) {
                ?>
                <p><a href="../public/index.php?route=validateComment&commentId=<?= $comment->getId(); ?>">Valider</a></p>
                <?php
                }
                ?>
                </div>          
            </div>
            <?php
            }
    ?>
    