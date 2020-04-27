


<div class="section">
    <div class="container">
        <h2>Commentaires de l'article : <?= htmlspecialchars($comments[array_key_first($comments)]->getPostObj()->getTitle());?></h2>
        <a href="../public/index.php?route=administration">Retour</a>
        <?php

        if (!empty($comments))
        {
            foreach ($comments as $comment) 
            {
                ?>  
            
                    <div class="row">
                        <div class="col-lg_12">
                            <h5>Posté le <?= htmlspecialchars($comment->getCreatedAt());?> par <?= htmlspecialchars($comment->getPseudo());?></h5>
                            <p><?= htmlspecialchars($comment->getContent());?></p>
                            <p><a href="../public/index.php?route=deleteComment&commentId=<?= $comment->getId(); ?>" onclick="return confirm('Vous allez supprimer définitivement ce message. êtes-vous certain de vouloir faire ça ?  ( Irréverssible !!)')">Supprimer le commentaire</a></p>
                            <?php
                            if ($comment->getValidate() === null) 
                            {
                            ?>
                            <p><a href="../public/index.php?route=validateComment&commentId=<?= $comment->getId(); ?>">Valider</a></p>
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
</div>       
  