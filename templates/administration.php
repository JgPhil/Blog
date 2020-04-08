<?php $this->title = 'Administration'; ?>

<h1>Mon blog</h1>
<p>En construction</p>
<a href="../public/index.php">Retour à l'accueil</a>
<?= $this->session->show('add_post'); ?>
<?= $this->session->show('edit_post'); ?>
<?= $this->session->show('delete_post'); ?>
<h2>Articles</h2>
<a href="../public/index.php?route=addPost">Nouvel article</a>
<table class="table">
    <tr>
        <td>Id</td>
        <td>Titre</td>
        <td>Châpo</td>
        <td>Contenu</td>
        <td>Auteur</td>
        <td>Date</td>
        <td>Actions</td>
    </tr>
    <?php
    foreach ($posts as $post)
    {
        ?>
        <tr>
            <td><?= htmlspecialchars($post->getId());?></td>
            <td><a href="../public/index.php?route=post&postId=<?= htmlspecialchars($post->getId());?>"><?= htmlspecialchars($post->getTitle());?></a></td>
            <td> <?= htmlspecialchars($post->getHeading()); ?></td>
            <td><?= substr(htmlspecialchars($post->getContent()), 0, 150);?></td>
            <td><?= htmlspecialchars($post->getAuthor());?></td>
            <td>Créé le : <?= htmlspecialchars($post->getCreatedAt());?></td>
            <td>
                <a href="../public/index.php?route=editPost&postId=<?= $post->getId(); ?>">Modifier</a>
                <a href="../public/index.php?route=deletePost&postId=<?= $post->getId(); ?>">Supprimer</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

<h2>Utilisateurs</h2>
<table class="table">
    <tr>
        <td>Id</td>
        <td>Pseudo</td>
        <td>Date</td>
        <td>Rôle</td>
        <td>Actions</td>
    </tr>
    <?php
    foreach ($users as $user)
    {
        ?>
        <tr>
            <td><?= htmlspecialchars($user->getId());?></td>
            <td><?= htmlspecialchars($user->getPseudo());?></td>
            <td>Créé le : <?= htmlspecialchars($user->getCreatedAt());?></td>
            <td><?= htmlspecialchars($user->getRole());?></td>
            <td>
                <?php
                if($user->getRole() != 'admin') {
                ?>
                <a href="../public/index.php?route=deleteUser&userId=<?= $user->getId(); ?>">Supprimer</a>
                <?php }
                else {
                    ?>
                Suppression impossible
                <?php
                }
                ?>
            </td>
        </tr>
        <?php
    }
    ?>
</table>