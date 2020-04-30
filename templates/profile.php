<?php $this->title = 'Mon profil'; ?>



<?php $this->title = "Inscription"; ?>


<!-- page title -->
<section class="page-title bg-primary position-relative">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="text-white font-tertiary">Profil</h1>
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

<section class="section">
  <div class="container">
    <div class="row text-center">
      <div class="col-lg-8 mx-auto">



        <div class="row ">
          <div class="col-lg-12 ">
            <div class="row text-center">
              <div class="col-lg-12 ">
                <p><a href="../public/index.php"><i class="fas fa-long-arrow-alt-left"></i> Retour à l'accueil</a></p>
                <div class="col-lg-12 text-center bg-light border mt-2"">
                  <h2><?= $this->session->get('pseudo'); ?></h2>
                </div>
                <div class="col-lg-12 text-center">
                  <h4>Rôle: <?= $this->session->get('role'); ?></h4>
                </div>
                <div class="col-lg-12 text-center">
                  <h4> Membre depuis le : <?= htmlspecialchars($posts[array_key_first($posts)]->getUserObj()->getCreatedAt());?></h4>
                </div>
              </div>
            </div>
          </div>




          <?php
          if ($this->session->get('update_password')) {
          ?>
            <h4 class="alert alert-success" role="alert"><?= $this->session->show('update_password') . ' <b>' . $this->session->get('pseudo') . '</b>'; ?></h4>
          <?php
          }
          ?>
        </div>
        <div class="row text-center ">
          <div class="col-lg-12 text-center ">
            <a class="btn btn-primary btn-xs" href="../public/index.php?route=updatePassword">Changer mot de passe</a>
            <a class="btn btn-danger btn-xs" href="../public/index.php?route=desactivateAccount&pseudo=<?= $this->session->get('pseudo') ?>" onclick="return confirm('êtes-vous sûr de vouloir supprimer votre compte ?')">Supprimer mon compte</a>
          </div>
        </div>
        <div class="text-center mt-5">
          <h4 class="bg-light border mt-2">Mes commentaires</h4>
          <div class="card">
            <?php
            if ($comments) {
              foreach ($comments as $comment) {
            ?>
                <div class="card">
                  <div class="card-body">
                    <h5>Posté le <?= htmlspecialchars($comment->getCreatedAt()) ?> dans l'article <?= htmlspecialchars($comment->getPost()->getTitle()) ?></h5>
                    <p><?= htmlspecialchars($comment->getContent()); ?></p>
                  </div>
                </div>
              <?php
              }
            } else {
              ?>
              <div class="card">
                <div class="card-body">
                  <h5>Rien pour le moment</h5>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
        <div class="text-center mt-5">
          <h4 class="bg-light border mt-2">Mes articles </h4>
          <div class="card">
            <?php
            if ($posts) {
              foreach ($posts as $post) {
            ?>
                <div class="card">
                  <div class="card-body">
                    <h5> Date: <?php print_r(htmlspecialchars($post->getCreatedAt())) ?></h5>
                    <h4><a href="../public/index.php?route=post&postId=<?php print_r(htmlspecialchars($post->getId())); ?>"><?php print_r(htmlspecialchars($post->getTitle())); ?></a></h4>
                  </div>
                </div>
              <?php
              }
            } else {
              ?>
              <div class="card">
                <div class="card-body">
                  <h5>Rien pour le moment</h5>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>