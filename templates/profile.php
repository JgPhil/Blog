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