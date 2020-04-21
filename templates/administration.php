<?php 

$this->title = 'Administration'; ?>



    
    <?= $this->session->show('add_post'); ?>
    <?= $this->session->show('edit_post'); ?>
    <?= $this->session->show('delete_post'); ?>
    <?= $this->session->show('delete_user'); ?>
    <?= $this->session->show('delete_comment');?>
    <?= $this->session->show('validate_comment'); ?>
    <?= $this->session->show('invalidate_comment'); ?>
    <?= $this->session->show('activate_account'); ?>

<!-- page title -->
<section class="page-title bg-primary position-relative">
  <div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="text-white font-tertiary">Espace <br>Administration</h1>
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
<!-- /page title -->

<div id="admin_navbar" class="container mt-500">
<nav class="navbar navbar-expand-lg">
        <div class="row">
            <ul class="navbar-nav navbar-dark mx-auto">
                <li class="nav-item"><a class="nav-link" href=<?=INDEX_PATH?>><i class="fas fa-long-arrow-alt-left"></i>  Retour à l'accueil</a></li>     
                <li class="nav-item"><a class="nav-link" href="#posts">Articles</a></li>
                <li class="nav-item"><a class="nav-link" href="#users">Utilisateurs</a></li>
                <li class="nav-item"><a class="nav-link" href="#comments">commentaires</a></li> 
            </ul> 
        </div>
    </nav>        
</div>    
    
    <div class="col-lg-10 mx-auto">
        <div class="bg-white rounded text-center p-5 shadow-down">
        <h3 id="posts" class="mb-80">Articles</h3>
        <a href=<?=INDEX_PATH.SLUG."addPost"?>>Nouvel article</a>
        <table class="table">
            <tr>
                <td>Id</td>
                <td>Titre</td>
                <td>Châpo</td>
                <td>Contenu</td>
                <td>Auteur</td>
                <td>Date</td>
                <td>Commentaires</td>
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
                    <td><?= substr(htmlspecialchars($post->getContent()), 0, 80);?></td>
                    <td><?= htmlspecialchars($post->getUserObj()->getPseudo());?> (<?=htmlspecialchars($post->getUserObj()->getRole())?>)</td>
                    <td>Créé le : <?= htmlspecialchars($post->getCreatedAt());?></td>
                    <td><a href="../public/index.php?route=postComments&postId=<?= htmlspecialchars($post->getId());?>">Voir les commentaires</a></td>
                    <td>
                        <a href="../public/index.php?route=editPost&postId=<?= $post->getId(); ?>">Modifier</a>
                        <a href="../public/index.php?route=deletePost&postId=<?= $post->getId(); ?>" onclick="return confirm('êtes-vous sûr de vouloir supprimer définitivement l\'article ?')">Supprimer</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table><br><br>

        <h3 id="users" class="mb-80">Utilisateurs</h2><br>
        <table class="table">
            <tr>
                <td>Id</td>
                <td>Pseudo</td>
                <td>Date</td>
                <td>Rôle</td>
                <td>Activation compte</td>
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
                            if ($user->getActivated() === '1')
                            {
                            ?>
                                 Compte actif 
                                <a href="../public/index.php?route=desactivateAccountAdmin&pseudo=<?= $user->getPseudo();?>" onclick="return confirm('êtes-vous sûr de vouloir désactiver l\'utilisateur ?')">Désactiver</a>
                            <?php
                            }
                            else 
                            {?>
                                <a href="../public/index.php?route=activateAccount&pseudo=<?=$user->getPseudo();?>" onclick="return confirm('êtes-vous sûr de vouloir activer l\'utilisateur ?')">Activer</a>
                            <?php
                            }?>
                        </td>                                                    
                            <td><a href="../public/index.php?route=deleteUser&userId=<?= $user->getId(); ?>" onclick="return confirm('êtes-vous sûr de vouloir supprimer définitivement l\'utilisateur ?')">Supprimer</a>
                            </td>
                            <?php }
                        else {
                            ?>
                        Suppression impossible
                        <?php
                        }
                        ?>
                </tr>
                <?php
            }
            ?>
        </table><br><br>

        <h2 id="comments" class="mb-80">Commentaires</h2><br>
        <table class="table">
            <tr>
                <td>Id</td>
                <td>Pseudo</td>
                <td>Article</td>
                <td>Message</td>
                <td>Date</td>
                <td>Validation</td>
                <td>Suppression</td>
            </tr>
            <?php
            foreach ($comments as $comment)
            {
                ?> 
                <tr>
                    <td><?= htmlspecialchars($comment->getId());?></td>
                    <td><?= htmlspecialchars($comment->getPseudo());?></td>
                    <td><?= htmlspecialchars($comment->getPost()->getTitle());?></td> <!--Appel à la méthode "getPostObj" du modèle "Comment" qui retourne un objet Post -->
                    <td><?= substr(htmlspecialchars($comment->getContent()), 0, 150);?></td>
                    <td>Créé le : <?= htmlspecialchars($comment->getCreatedAt());?></td>
                    <td>
                    <?php
                    if ($comment->getValidate() === '0') 
                    { ?>
                        <a href="../public/index.php?route=validateComment&commentId=<?= $comment->getId(); ?>">Valider le commentaire</a></td>
                        <?php
                    } else 
                    {
                        echo ('Commentaire validé');
                    ?>
                        <a href="../public/index.php?route=invalidateComment&commentId=<?= $comment->getId(); ?>">Invalider le commentaire</a></td>
                    <?php
                    }
                    ?>
                    <td><a href="../public/index.php?route=deleteComment&commentId=<?= $comment->getId(); ?>" class="text-danger" onclick=" return confirm('êtes-vous sûr de vouloir supprimer définitivement le commentaire')">Supprimer le commentaire</a></td>
                    
                </tr>
                <?php
            }
            ?>
        </table>
        </div>
    </div>
</div>
