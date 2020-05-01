<?php

use App\src\constraint\Text;

$this->title = "Accueil"; ?>



<!-- hero area -->
<section class="hero-area bg-primary" id="parallax">
  <div class="container">
    <div class="row text-center">
      <div class="col-lg-11 mx-auto">
        <h1 class="text-white font-tertiary"><br><strong> Philippe Jaming<br> Web developer</strong></h1>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row text-center">
      <div class="col-lg-10 mx-auto">
        <h4 class="text-white font-tertiary"><br><strong> Expression numérique et personnelle de mon parcours professionnel dans le développement informatique</strong></h4>
      </div>
    </div>
  </div>


  <div class="layer-bg w-100">
    <img class="img-fluid w-100" src="images/illustrations/leaf-bg.png" alt="bg-shape">
  </div>
  <div class="layer" id="l2">
    <img src="images/illustrations/dots-cyan.png" alt="bg-shape">
  </div>
  <div class="layer" id="l3">
    <img src="images/illustrations/leaf-orange.png" alt="bg-shape">
  </div>
  <div class="layer" id="l4">
    <img src="images/illustrations/dots-orange.png" alt="bg-shape">
  </div>
  <div class="layer" id="l5">
    <img src="images/illustrations/leaf-yellow.png" alt="bg-shape">
  </div>
  <div class="layer" id="l6">
    <img src="images/illustrations/leaf-cyan.png" alt="bg-shape">
  </div>
  <div class="layer" id="l7">
    <img src="images/illustrations/dots-group-orange.png" alt="bg-shape">
  </div>
  <div class="layer" id="l8">
    <img src="images/illustrations/leaf-pink-round.png" alt="bg-shape">
  </div>
  <div class="layer" id="l9">
    <img src="images/illustrations/leaf-cyan-2.png" alt="bg-shape">
  </div>
  <!-- social icon -->
  <ul class="list-unstyled ml-5 mt-3 position-relative zindex-1">
    <li class="mb-3"><a class="text-white" href="https://github.com/JgPhil"><i class="ti-github"></i></a></li>
    <li class="mb-3"><a class="text-white" href="https://twitter.com/bootsnipp"><i class="ti-twitter"></i></a></li>
    <li class="mb-3"><a class="text-white" href="https://www.linkedin.com/in/philippe-j-61a477194/"><i class="ti-linkedin"></i></a></li>
    <li class="mb-3"><a class="text-white" href="Location:../public/index.php?route=contact"><i class="ti-email"></i></a></li>
  </ul>
  <!-- /social icon -->
</section>
<!-- /hero area -->

<!-- blog -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="container row">
          <div class="col-lg-8 mx-auto">
            <?php
            if ($this->session->get('register')) {
            ?>
              <h4 class="alert alert-success" role="alert"><?= htmlentities($this->session->show('register')) . ' <b>' . htmlentities($this->session->get('pseudo')) . '</b>'; ?></h4>
            <?php
            } elseif ($this->session->get('confirm_email')) {
            ?>
              <h4 class="alert alert-success" role="alert"><?= htmlentities($this->session->show('confirm_email')) ?></h4>
            <?php
            } elseif ($this->session->get('login')) {
            ?>
              <h4 class="alert alert-success" role="alert"><?= htmlentities($this->session->show('login')) . ' <b>' . htmlentities($this->session->get('pseudo')) . '</b>'; ?></h4>
            <?php
            } elseif ($this->session->get('logout')) {
            ?>
              <h4 class="alert alert-success" role="alert"><?= htmlentities($this->session->show('logout')) . ' <b>' . htmlentities($this->session->get('pseudo')) . '</b>'; ?></h4>
            <?php
            } elseif ($this->session->get('delete_account')) {
            ?>
              <h4 class="alert alert-success" role="alert"><?= htmlentities($this->session->show('delete_account')) . ' <b>' . htmlentities($this->session->get('pseudo')) . '</b>'; ?></h4>
            <?php
            }
            ?>
          </div>
        </div>
        <h2 class="section-title">Blog</h2>

      </div>
      <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
        <article class="card shadow">
          <img class="rounded card-img-top" src="images/blog/post-3.jpg" alt="post-thumb">
          <div class="card-body">
            <h4 class="card-title"><a href=<?= INDEX_PATH . SLUG . "post&postId=" . htmlentities($posts[23]->getId()); ?>><?= htmlentities($posts[23]->getTitle()); ?></a></h4>
            <h5><?= htmlentities($posts[23]->getHeading()); ?></h5>
            <p>Ajouté le : <?= htmlentities($posts[23]->getCreatedAt()); ?></p>
            <p class="cars-text"><?= htmlentities(Text::excerpt($posts[23]->getContent())); ?></p>
            <a href=<?= INDEX_PATH . SLUG . "post&postId=" . htmlentities($posts[23]->getId()); ?> class="btn btn-xs btn-primary">Voir Plus</a>
          </div>
        </article>
      </div>
      <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
        <article class="card shadow">
          <img class="rounded card-img-top" src="images/blog/post-3.jpg" alt="post-thumb">
          <div class="card-body">
            <h4 class="card-title"><a href=<?= INDEX_PATH . SLUG . "post&postId=" . htmlentities($posts[22]->getId()); ?>><?= htmlentities($posts[22]->getTitle()); ?></a></h4>
            <h5><?= htmlentities($posts[22]->getHeading()); ?></h5>
            <p>Ajouté le : <?= htmlentities($posts[22]->getCreatedAt()); ?></p>
            <p class="cars-text"><?= htmlentities(Text::excerpt($posts[22]->getContent())); ?></p>
            <a href=<?= INDEX_PATH . SLUG . "post&postId=" . htmlentities($posts[22]->getId()); ?> class="btn btn-xs btn-primary">Voir Plus</a>
          </div>
        </article>
      </div>
      <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
        <article class="card shadow">
          <img class="rounded card-img-top" src="images/blog/post-3.jpg" alt="post-thumb">
          <div class="card-body">
            <h4 class="card-title"><a href=<?= INDEX_PATH . SLUG . "post&postId=" . htmlentities($posts[21]->getId()); ?>><?= htmlentities($posts[21]->getTitle()); ?></a></h4>
            <h5><?= htmlentities($posts[21]->getHeading()); ?></h5>
            <p>Ajouté le : <?= htmlentities($posts[21]->getCreatedAt()); ?></p>
            <p class="cars-text"><?= htmlentities(Text::excerpt($posts[21]->getContent())); ?></p>
            <a href=<?= INDEX_PATH . SLUG . "post&postId=" . htmlentities($posts[21]->getId()); ?> class="btn btn-xs btn-primary">Voir Plus</a>
          </div>
        </article>
      </div>
    </div>
  </div>
</section>
<!-- /blog -->