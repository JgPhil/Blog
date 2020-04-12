
<h2>Commentaires de l'article : </h2>

<?php
        foreach ($comments as $comment) {
            ?>
            <div class="card">
                <div class="card-body"><h5>Posté le <?= htmlspecialchars($comment->getCreatedAt());?> par <?= htmlspecialchars($comment->getPseudo());?></h5>
                <p><?= htmlspecialchars($comment->getContent());?></p>
                <p><a href="../public/index.php?route=deleteComment&commentId=<?= $comment->getId(); ?>">Supprimer le commentaire</a></p>
                <p><a href="../public/index.php?route=validateComment&commentId=<?= $comment->getId(); ?>">Valider</a></p>
                </div>          
            </div>
            <?php
            }
    ?>
    