<?php 
use App\src\constraint\Text;

$this->title = "Accueil"; ?>
    <?= $this->session->show('register'); ?>
    <?= $this->session->show('login'); ?>
    <?= $this->session->show('logout'); ?>
    <?= $this->session->show('delete_account'); ?>


    <!-- hero area -->
<section class="hero-area bg-primary" id="parallax">
  <div class="container">
    <div class="row">
      <div class="col-lg-11 mx-auto">
        <h1 class="text-white font-tertiary"><br> Philippe Jaming<br> Web developer</h1>
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
    <li class="mb-3"><a class="text-white" href="#"><i class="ti-facebook"></i></a></li>
    <li class="mb-3"><a class="text-white" href="#"><i class="ti-instagram"></i></a></li>
    <li class="mb-3"><a class="text-white" href="#"><i class="ti-dribbble"></i></a></li>
    <li class="mb-3"><a class="text-white" href="#"><i class="ti-twitter"></i></a></li>
  </ul>
  <!-- /social icon -->
</section>
<!-- /hero area -->

<!-- blog -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h2 class="section-title">Blog</h2>
        </div>
      <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
        <article class="card shadow">
          <img class="rounded card-img-top" src="images/blog/post-3.jpg" alt="post-thumb">
          <div class="card-body">
            <h4 class="card-title"><a href=<?=INDEX_PATH.SLUG."post&postId=".htmlspecialchars($posts[14]->getId());?>><?= htmlspecialchars($posts[14]->getTitle());?></a></h4>
            <h5><?= htmlspecialchars($posts[14]->getHeading());?></h5>
            <p>Ajouté le : <?= htmlspecialchars($posts[14]->getCreatedAt());?></p> 
            <p class="cars-text"><?= htmlspecialchars(Text::excerpt($posts[14]->getContent()));?></p>
            <a href=<?=INDEX_PATH.SLUG."post&postId=".htmlspecialchars($posts[14]->getId());?> class="btn btn-xs btn-primary">Voir Plus</a>
          </div>
        </article>
      </div>
      <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
      <article class="card shadow">
          <img class="rounded card-img-top" src="images/blog/post-3.jpg" alt="post-thumb">
          <div class="card-body">
            <h4 class="card-title"><a href=<?=INDEX_PATH.SLUG."post&postId=".htmlspecialchars($posts[13]->getId());?>><?= htmlspecialchars($posts[13]->getTitle());?></a></h4>
            <h5><?= htmlspecialchars($posts[13]->getHeading());?></h5>
            <p>Ajouté le : <?= htmlspecialchars($posts[13]->getCreatedAt());?></p> 
            <p class="cars-text"><?= htmlspecialchars(Text::excerpt($posts[13]->getContent()));?></p>
            <a href=<?=INDEX_PATH.SLUG."post&postId=".htmlspecialchars($posts[13]->getId());?> class="btn btn-xs btn-primary">Voir Plus</a>
          </div>
        </article>
      </div>
      <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
      <article class="card shadow">
          <img class="rounded card-img-top" src="images/blog/post-3.jpg" alt="post-thumb">
          <div class="card-body">
            <h4 class="card-title"><a href=<?=INDEX_PATH.SLUG."post&postId=".htmlspecialchars($posts[1]->getId());?>><?= htmlspecialchars($posts[1]->getTitle());?></a></h4>
            <h5><?= htmlspecialchars($posts[1]->getHeading());?></h5>
            <p>Ajouté le : <?= htmlspecialchars($posts[1]->getCreatedAt());?></p> 
            <p class="cars-text"><?= htmlspecialchars(Text::excerpt($posts[1]->getContent()));?></p>
            <a href=<?=INDEX_PATH.SLUG."post&postId=".htmlspecialchars($posts[1]->getId());?> class="btn btn-xs btn-primary">Voir Plus</a>
          </div>
        </article>
      </div>
    </div>
  </div>
</section>
<!-- /blog -->



   