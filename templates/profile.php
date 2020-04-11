<?php $this->title = 'Mon profil'; ?>
<h1>Mon blog</h1>
<p>En construction</p>
<?= $this->session->show('update_password'); ?>
<div>
    <h2><?= $this->session->get('pseudo'); ?></h2>
    <a href="../public/index.php?route=updatePassword">Modifier son mot de passe</a>
    <a href="../public/index.php?route=deleteAccount">Supprimer mon compte</a>
</div>
    <div class="card">
    <?php
        foreach ($comments as $comment) {
            ?>
            <div class="card">
                <div class="card-body"><h5>Posté le <?= htmlspecialchars($comment->getCreatedAt());?></h5>
                <p><?= htmlspecialchars($comment->getContent());?></p>
                </div>          
            </div>
            <?php
            }
    ?>
    
</div>
<br>
<a href="../public/index.php">Retour à l'accueil</a>