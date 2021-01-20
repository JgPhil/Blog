<?php $this->title = "register"; ?>


<!-- page title -->
<section class="page-title bg-primary position-relative">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="text-white font-tertiary">Enregistrement</h1>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- register -->
<section class="section section-on-footer" data-background="images/backgrounds/bg-dots.png">
  <div class="container">
    <div class="row">
      <div>
        <p><a href="/"><i class="fas fa-long-arrow-alt-left"></i> Retour à l'accueil</a></p>
      </div>
      <div class="col-lg-8 mx-auto">
        <div class="bg-white rounded text-center p-5 shadow-down">
          <h4 class="mb-80">Merci de renseigner un pseudonyme et un mot de passe valide.<br><b>( Au moins: une minuscule, une majuscule et un chiffre )</b> </h4>

          <!--  FORM -->
          <form method="post" enctype="multipart/form-data" action="<?= SLUG . "register" ?>" class="row">
            <div class="col-md-4">
              <input type="text" id="pseudo" name="pseudo" placeholder="Votre pseudonyme" class="form-control px-0 mb-4">
              <?php
              if (isset($errors['pseudo'])) {
              ?>
                <div class="alert alert-danger" role="alert"><?= htmlentities($errors['pseudo']); ?></div>
              <?php
              }
              ?>
            </div>
            <div class="col-md-4">
              <input type="text" id="password" name="password" placeholder="Entrez un mot de passe" class="form-control px-0 mb-4">
              <?php
              if (isset($errors['password'])) {
              ?>
                <div class="alert alert-danger" role="alert"><?= htmlentities($errors['password']); ?></div>
              <?php
              }
              ?>
            </div> <!-- EMAIL-->
            <div class="col-md-4">
              <input type="email" id="email" name="email" placeholder="Entrez votre email" class="form-control px-0 mb-4">
              <?php
              if (isset($errors['email'])) {
              ?>
                <div class="alert alert-danger" role="alert"><?= htmlentities($errors['email']); ?></div>
              <?php
              }
              ?>
            </div><!-- /EMAIL-->

            <p><b>Image</b></p>
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <input name="userfile" class="form-control" type="file" />
            <div class="col-lg-6 col-10 mx-auto">

              <input type="submit" value="Inscription" id="submit" name="submit" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /contact -->