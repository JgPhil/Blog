<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title><?= htmlentities($title) ?></title>

  <!-- mobile responsive meta -->

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- ** Plugins Needed for the Project ** -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
  <!-- Fontawesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
  <!-- slick slider -->
  <link rel="stylesheet" href="plugins/slick/slick.css">
  <!-- themefy-icon -->
  <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">

  <!-- Main Stylesheet -->
  <link href="css/style.css" rel="stylesheet">

  <!--Favicon-->
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">

</head>


<body>

  <!-- Navbar -->

  <header class="navigation fixed-top">
    <nav class="navbar navbar-expand-lg navbar-dark">
      <a class="navbar-brand font-tertiary h3" href=<?= htmlentities(INDEX_PATH) ?>><img src="images/logo.png" alt="Myself"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse text-center" id="navigation">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href=<?= INDEX_PATH ?>>Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href=<?= INDEX_PATH . SLUG . 'contact' ?>>Contact</a>
          </li>


          <?php if ($this->session->get('pseudo')) {
            if ($this->session->get('role') === 'admin') {
          ?>
              <li class="nav-item">
                <a class="nav-link" href=<?= INDEX_PATH . SLUG . "administration" ?>><span class="fas fa-toolbox"></span> Administration</a>
              </li>
            <?php
            }
            ?>
            <li class="nav-item">
              <a class="nav-link" href=<?= INDEX_PATH . SLUG . "profile" ?>><span class="fas fa-id-card"></span> Mon profil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href=<?= INDEX_PATH . SLUG . "logout" ?>><span class="fas fa-sign-out_alt"></span> Se déconnecter</a>
            </li>

          <?php
          } else {
          ?>

            <li class="nav-item">
              <a class="nav-link" href=<?= INDEX_PATH . SLUG . "register" ?>><span class="fas fa-user"></span> S'inscrire</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href=<?= INDEX_PATH . SLUG . "login" ?>><span class="fas fa-sign-in-alt"></span> Connexion</a>
            </li>
        
        <?php
          }
        ?>
      </ul>
      </div>
    </nav>

  </header>




  <div id="content">
    <?= $content ?>
    <!--View Class renderView method-->
  </div>



  <!-- Social links. @TODO: replace by link/instructions in template -->
  <section id="social">
    <div class="container">
      <div class="wrapper clearfix">
        <!-- AddThis Button BEGIN -->
        <div class="addthis_toolbox addthis_default_style">
          <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
          <a class="addthis_button_tweet"></a>
          <a class="addthis_button_linkedin_counter"></a>
          <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
        </div>
        <!-- AddThis Button END -->
      </div>
    </div>
  </section>
  <!-- /social links -->

  <!-- footer -->
  <footer class="bg-dark footer-section">
    <div class="section">
      <div class="container">
        <div>
          <div class="container">
            <hr />
            <div class="text-center center-block">
              <br />
              <a href="https://github.com/JgPhil"><i class="fab fa-github-square fa-3x social"></i></a>
              <a href="https://twitter.com/bootsnipp"><i class="fa fa-twitter-square fa-3x social"></i></a>
              <a href="https://openclassrooms.com/fr/membres/philippe-jaming"><i class="fas fa-graduation-cap fa-3x social"></i></a>
              <a href="mailto:jamingph@gmail.com"><i class="fa fa-envelope-square fa-3x social"></i></a>
              <a href="#"><i class="fa fa-linkedin-square fa-3x social"></i></a>
              <hr />
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <h5 class="text-light">Email</h5>
              <p class="text-white paragraph-lg font-secondary">steve.fruits@email.com</p>
            </div>
            <div class="col-md-4">
              <h5 class="text-light">Phone</h5>
              <p class="text-white paragraph-lg font-secondary">+880 2544 658 256</p>
            </div>
            <div class="col-md-4">
              <h5 class="text-light">Address</h5>
              <p class="text-white paragraph-lg font-secondary">125/A, CA Commercial Area, California, USA</p>
            </div>
          </div>

        </div>
      </div>
      <div class="border-top text-center border-dark py-5">

        <p class="mb-0 text-light">Copyright ©<script>
            var CurrentYear = new Date().getFullYear()
            document.write(CurrentYear)
          </script> a theme by <a href="https://themefisher.com">themefisher.com</a></p>
      </div>
    </div>
  </footer>
  <!-- /footer -->

  <!-- jQuery -->
  <script src="plugins/jQuery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="plugins/bootstrap/bootstrap.min.js"></script>
  <!-- slick slider -->
  <script src="plugins/slick/slick.min.js"></script>
  <!-- filter -->
  <script src="plugins/shuffle/shuffle.min.js"></script>

  <!-- Main Script -->
  <script src="js/script.js"></script>

</body>

</html>