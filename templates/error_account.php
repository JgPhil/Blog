<?php $this->title = "Inscription"; ?>


<!-- page title -->
<section class="page-title bg-primary position-relative">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="text-white font-tertiary">Oups...</h1>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- register -->
<section class="section " data-background="images/backgrounds/bg-dots.png">
  <div class="container"></div>
  <div class="row">
    <div>
      <p><a href="../public/index.php"><i class="fas fa-long-arrow-alt-left"></i> Retour à l'accueil</a></p>
    </div>
    <div class="col-lg-8 mx-auto">
      <div class="bg-white rounded text-center p-5 shadow-down">
        <h4 class="mb-80"><?= htmlentities($this->session->show('error_account')) ; ?></b> </h4>
      </div>
    </div>
  </div>
  </div>
</section>
<!-- /contact -->