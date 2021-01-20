<?php
$route = isset($postMethod) && $postMethod->getParameter('id') ? 'editPost&postId=' . htmlspecialchars($postMethod->getParameter('id'))  : 'addPost'; // route appelée à la soumission du formulaire
$submit = $route === 'addPost' ? 'Envoyer' : 'Mettre à jour'; // valeur du bouton 
$h2 = $route === 'addPost' ? 'Rédaction d\'un article' : 'Mis à jour de l\'article : ' . htmlspecialchars($postMethod->getParameter('title'));
?>

<!-- page title -->
<section class="page-title bg-primary position-relative">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="text-white font-tertiary">Espace rédaction</h1>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<div class="section">
  <div class="container">
    <h2 class="title"><?= $h2 ?></h2>

  </div>
</div>


<section class="section">
  <div class="container">
    <div>
      <p><a href='/'><i class="fas fa-long-arrow-alt-left"></i> Retour à l'accueil</a></p>
    </div>
    <form method="post" enctype="multipart/form-data" action="<?= SLUG . htmlentities($route); ?>">

      <div class="form-group">

        <label for="title"><b>Auteur</b></label><br>
        <input type="text" class="form-control" id="author" name="author" value="<?= $this->session->get('pseudo'); ?> " readonly><br>

        <label for="title"><b>Titre</b></label><br>
        <input type="text" class="form-control" id="title" name="title" value="<?= isset($postMethod) ? $postMethod->getParameter('title') : ''; ?>"><br>
        <?= isset($errors['title']) ? $errors['title'] : ''; ?>

        <label for="heading"><b>Châpo</b></label><br>
        <input type="text" class="form-control" id="heading" name="heading" value="<?= isset($postMethod) ? $postMethod->getParameter('heading') : ''; ?>"><br>
        <?= isset($errors['heading']) ? $errors['heading'] : ''; ?>

        <label for="content"><b>Contenu</b></label><br>
        <textarea class="form-control" rows="12" id="content" name="content"><?= isset($postMethod) ? $postMethod->getParameter('content') : ''; ?></textarea><br>
        <?= isset($errors['content']) ? $errors['content'] : ''; ?>

        <p><b>Image actuelle: </b><em><?= isset($postMethod) && $postMethod->getParameter('picturePath') ? $postMethod->getParameter('picturePath')->getName() : ''; ?></em></p>
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
        <input name="userfile" class="form-control" type="file" />
      </div>
      <input type="submit" class="btn btn-primary" value="<?= htmlentities($submit); ?>" id="submit" name="submit">

    </form>
  </div>
</section>