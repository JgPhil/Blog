<?php $this->title = "Inscription"; ?>
<h1>Mon blog</h1>
<p>En construction</p>

<!-- register -->
<section class="section section-on-footer" data-background="images/backgrounds/bg-dots.png">
  <div class="container">
    <div class="row">
        <div>
          <p><a href="../public/index.php" ><i class="fas fa-long-arrow-alt-left"></i>  Retour à l'accueil</a></p>
        </div>
    <div class="col-12 text-center">
        <h2 class="section-title">Enregistrement</h2>
    </div>
        <div class="col-lg-8 mx-auto">
            <div class="bg-white rounded text-center p-5 shadow-down">
            <h4 class="mb-80">Enregistrement</h4>
            <form method="post" action=<?=INDEX_PATH.SLUG."register"?> class="row">
            <div class="col-md-6">
                <input type="text" id="pseudo" name="pseudo" placeholder="Votre pseudonyme" class="form-control px-0 mb-4">
                <?php
                if (isset($errors['pseudo']))
                {
                ?>    
                    <div class="alert alert-danger" role="alert"><?= $errors['pseudo']; ?></div>
                <?php    
                }
                ?> 
            </div>
            <div class="col-md-6">
                <input type="text" id="password" name="password" placeholder="Entrez un mot de passe" class="form-control px-0 mb-4">
                <?php
                if (isset($errors['password']))
                {
                ?>    
                    <div class="alert alert-danger" role="alert"><?= $errors['password']; ?></div>
                <?php    
                }
                ?>    
            </div>
            <div class="col-lg-6 col-10 mx-auto">
                <input type="submit" value="Inscription" id="submit" name="submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /contact -->