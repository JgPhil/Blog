<?php $this->title = "Confirmation2"; ?>


<!-- page title -->
<section class="page-title bg-primary position-relative">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="text-white font-tertiary">Enregistrement</h1>
      </div>
    </div>
  </div>
<!-- /page title -->

<!-- register -->
<section class="section " data-background="images/backgrounds/bg-dots.png">
  <div class="container">
    <div class="row">
        <div>
          <p><a href="/" ><i class="fas fa-long-arrow-alt-left"></i>  Retour à l'accueil</a></p>
        </div>
        <div class="col-lg-8 mx-auto">
            <div class="bg-white rounded text-center p-5 shadow-down">
            <h4 class="mb-80"><b><?= $this->session->show('email_confirmation');?></b> </h4>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /contact -->