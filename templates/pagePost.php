<?php $this->title = "Article"; ?>

<!-- page title -->
<section class="page-title bg-primary position-relative">
  <div class="container">
    <div class="row">
      <?php
      if ($this->session->get('add_comment')) {
      ?>
        <div class="alert alert-success" role="alert"><?= $this->session->show('add_comment'); ?></div>
      <?php
      }
      ?>
      <div class="col-12 text-center">
        <h1 class="text-white font-tertiary">Blog</h1>
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
    <div>
      <p><a href="../public/index.php"><i class="fas fa-long-arrow-alt-left"></i> Retour à l'accueil</a></p>
    </div>
    <div class="row text-center ">
      <div class="col-lg-12">
        <div class="container row">
          <div class="row text-center">
            <div class="col-lg-8 mx-auto ">
              <?php
              if ($this->session->get('logout')) {
              ?>
                <h4 class="alert alert-success" role="alert"><?= htmlentities($this->session->show('add_comment')) . ' <b>' . htmlentities($this->session->get('pseudo')) . '</b>'; ?></h4>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
        <h3 class="font-tertiary mb-4"><?= htmlentities($post->getTitle()); ?></h3>
        <h4 class="font-tertiary mb-2"><?= htmlentities($post->getHeading()); ?></h4>
        <p class="font-secondary">Dernière modif. le <?= htmlentities($post->getLastUpdate()); ?> par <span class="text-primary"><?= htmlentities($post->getAuthor()); ?></span></p>
        <div class="content">
          <img src=<?=BLOG_PICTURE.htmlentities($picturePath['path'])?> alt="post-thumb" class="img-fluid rounded float-left mr-5 mb-4">

          <p><?= htmlentities($post->getContent()); ?></p>
        </div>
      </div>
    </div>
  </div>
</section>



<section>
  <div class="container">
    <div class="row">

      <div class="col-lg-12">
        <h4 class="font-weight-bold mb-3">Commentaires</h4>

        <?php
        foreach ($comments as $comment) {
        ?>
          <div class="bg-gray p-4 mb-4">
            <div class="media border-bottom py-2">
              <img src="images/user-1.jpg" class="img-fluid align-self-start rounded-circle mr-3" alt="">
              <div class="media-body">
                <h5 class="mt-0"><?= htmlentities($comment->getUser()->getPseudo()); ?></h5>
                <p><?= htmlentities($comment->getCreatedAt()); ?></p>
                <p><?= htmlentities($comment->getContent()); ?></p>
              </div>
            </div>
          </div>

        <?php
        }

        if ($this->session->get('pseudo')) //si l'utilisateur est connecté avec un compte validé Alors on affiche le formulaire commentaire
        {
        ?>
          <h4>Laissez un commentaire</h4>
          <form method="post" action=<?= INDEX_PATH . SLUG . "addComment&postId=" . htmlentities($post->getId()); ?> class="row">
            <div class="col-md-6">
              <input type="text" class="form-control mb-3"  name="id" id= "id" value="<?= $this->session->get('pseudo'); ?> " readonly>
            </div>
            <div class="col-md-6">
              <?php
              if (isset($errors['content'])) {
              ?>
                <div class="alert alert-danger" role="alert"><?= $errors['content']; ?></div>
              <?php
              }
              ?>
              <textarea name="content" id="content" placeholder="Message" class="form-control mb-4"></textarea>
              <input type="submit" class="btn btn-primary w-100" id="submit" value="Soumettre" name="submit" />
            </div>
          </form>
        <?php
        } else {
        ?>
          <h4 class="font-weight-bold mb-3 border-bottom pb-3">Merci de vous inscrire si vous souhaitez laisser un commentaire.</h4>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</section>