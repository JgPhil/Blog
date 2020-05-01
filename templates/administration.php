<?php

$this->title = 'Administration'; ?>

<!-- page title -->
<section class="page-title bg-primary position-relative">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">



                <div class="col-lg-12 text-center">
                    <div class="container row">
                        <div class="col-lg-8 mx-auto">
                            <?php
                            if ($this->session->get('add_post')) {
                            ?>
                                <h4 class="alert alert-success" role="alert"><?= htmlentities($this->session->show('add_post')) ?></h4>
                            <?php
                            } elseif ($this->session->get('edit_post')) {
                            ?>
                                <h4 class="alert alert-success" role="alert"><?= htmlentities($this->session->show('edit_post')) ?></h4>
                            <?php
                            } elseif ($this->session->get('delete_post')) {
                            ?>
                                <h4 class="alert alert-success" role="alert"><?= htmlentities($this->session->show('delete_post')) ?></h4>
                            <?php
                            } elseif ($this->session->get('delete_comment')) {
                            ?>
                                <h4 class="alert alert-success" role="alert"><?= htmlentities($this->session->show('delete_comment')) ?></h4>
                            <?php
                            } elseif ($this->session->get('validate_comment')) {
                            ?>
                                <h4 class="alert alert-success" role="alert"><?= htmlentities($this->session->show('validate_comment')) ?></h4>
                            <?php
                            } elseif ($this->session->get('invalidate_comment')) {
                            ?>
                                <h4 class="alert alert-success" role="alert"><?= htmlentities($this->session->show('invalidate_comment')) ?></h4>
                            <?php
                            } elseif ($this->session->get('activate_account')) {
                            ?>
                                <h4 class="alert alert-success" role="alert"><?= htmlentities($this->session->show('activate_account')) ?></h4>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

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
                <li class="nav-item"><a class="nav-link" href=<?=htmlentities(INDEX_PATH)?>><i class="fas fa-long-arrow-alt-left"></i> Retour à l'accueil</a></li>
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
        <a href=<?= htmlentities(INDEX_PATH) . htmlentities(SLUG) . "addPost" ?>>Nouvel article</a>
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
            foreach ($posts as $post) {

                if ($post->getVisible() === "1") {
            ?>
                    <tr>
                        <td><?=htmlentities($post->getId()); ?></td>
                        <td><a href="../public/index.php?route=post&postId=<?=htmlentities($post->getId()); ?>"><?=htmlentities($post->getTitle()); ?></a></td>
                        <td> <?=htmlentities($post->getHeading()); ?></td>
                        <td><?=substr(htmlentities($post->getContent()), 0, 80); ?></td>
                        <td><?=htmlentities($post->getUser()->getPseudo()); ?> (<?=htmlentities($post->getUser()->getRole())?>)</td>
                        <td>Créé le : <?=htmlentities($post->getCreatedAt()); ?></td>
                        <td><a href="../public/index.php?route=postComments&postId=<?=htmlentities($post->getId()); ?>">Voir les commentaires</a></td>
                        <td>
                            <a href="../public/index.php?route=editPost&postId=<?=htmlentities($post->getId()); ?>">Modifier</a>
                            <a href="../public/index.php?route=hidePost&postId=<?=htmlentities($post->getId()); ?>" onclick="return confirm('êtes-vous sûr de vouloir mettre l\'article à la corbeille?')">Supprimer</a>
                        </td>
                    </tr>
            <?php
                }
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
                    <td>Suppression</td>
                </tr>
                <?php

                foreach ($users as $user) {
                    if ($user->getVisible() === "1") {

                ?>
                        <tr>
                            <td><?php print_r(htmlspecialchars($user->getId())); ?></td>
                            <td><?php print_r(htmlspecialchars($user->getPseudo())); ?></td>
                            <td>Créé le : <?php print_r(htmlspecialchars($user->getCreatedAt())); ?></td>
                            <td>

                                <?php


                                if ($user->getRole() != 'admin') {
                                ?>Utilisateur
                                <a href="../public/index.php?route=setAdmin&pseudo=<?php print_r(htmlspecialchars($user->getPseudo())); ?>" onclick="return confirm('êtes-vous sûr de vouloir donner le statut administrateur à l\'utilisateur ?')">Promouvoir</a>
                            <?php
                                } else {
                                    print_r('Administrateur');
                                }
                            ?>
                            </td>

                            <td>
                                <?php
                                if ($user->getRole() != 'admin') {
                                    if ($user->getActivated() === '1') {
                                ?>
                                        Compte actif
                                        <a href="../public/index.php?route=desactivateAccountAdmin&pseudo=<?php print_r(htmlspecialchars($user->getPseudo())); ?>" onclick="return confirm('êtes-vous sûr de vouloir désactiver l\'utilisateur ?')">Désactiver</a>
                                    <?php
                                    } else { ?>
                                        <a href="../public/index.php?route=activateAccount&pseudo=<?php print_r(htmlspecialchars($user->getPseudo())); ?>" onclick="return confirm('êtes-vous sûr de vouloir activer l\'utilisateur ?')">Activer</a>
                                    <?php
                                    } ?>
                            </td>
                            <td><a href="../public/index.php?route=hideUser&userId=<?php print_r(htmlspecialchars($user->getId())); ?>" onclick="return confirm('êtes-vous sûr de vouloir mettre l\'utilisateur à la corbeille?')">Supprimer</a>
                            </td>
                        <?php } else {
                        ?>
                            Suppression impossible
                        <?php
                                }
                        ?>
                        </tr>
                <?php
                    }
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
                foreach ($comments as $comment) {
                    if ($comment->getVisible() === '1') {

                ?>
                        <tr>
                            <td><?php print_r(htmlspecialchars($comment->getId())); ?></td>
                            <td><?php print_r(htmlspecialchars($comment->getPseudo())); ?></td>
                            <td><?php print_r(htmlspecialchars($comment->getPost()->getTitle())); ?></td>
                            <!--Appel à la méthode "getPostObj" du modèle "Comment" qui retourne un objet Post -->
                            <td><?php print_r(substr(htmlspecialchars($comment->getContent()), 0, 150)); ?></td>
                            <td>Créé le : <?php print_r(htmlspecialchars($comment->getCreatedAt())); ?></td>
                            <td>
                                <?php
                                if ($comment->getValidate() === '0') { ?>
                                    <a href="../public/index.php?route=validateComment&commentId=<?php print_r(htmlspecialchars($comment->getId())); ?>">Valider le commentaire</a></td>
                        <?php
                                } else {
                                    echo ('Commentaire validé');
                        ?>
                            <a href="../public/index.php?route=invalidateComment&commentId=<?php print_r(htmlspecialchars($comment->getId())); ?>">Invalider le commentaire</a></td>
                        <?php
                                }
                        ?>
                        <td><a href="../public/index.php?route=hideComment&commentId=<?php print_r(htmlspecialchars($comment->getId())); ?>" class="text-danger" onclick=" return confirm('êtes-vous sûr de vouloir supprimer définitivement le commentaire')">Supprimer le commentaire</a></td>

                        </tr>
                <?php
                    }
                }


                ?>
            </table>
    </div>
</div>
</div>