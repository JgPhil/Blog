

<?php
$route = isset($postMethod) && $postMethod->getParameter('id') ? 'editPost&postId='.htmlentities($postMethod->getParameter('id'))  : 'addPost';
$submit = $route === 'addPost' ? 'Envoyer' : 'Mettre à jour';
$h2 = $route === 'addPost' ? 'Rédaction d\'un article' : 'Mis à jour de l\'article : '.htmlentities($postMethod->getParameter('title'));
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

<div class="section">
    <div class="container">
        <h2 class="title"><?=htmlentities($h2)?></h2>
    </div>
</div>


<section class="section">
    <div class="container">
        <div>
            <p><a href=<?=INDEX_PATH?> ><i class="fas fa-long-arrow-alt-left"></i>  Retour à l'accueil</a></p>
        </div>
            <form method="post" action=<?=INDEX_PATH.SLUG.htmlentities($route);?>>
                <div class="form-group">
                    <label for="title">Auteur</label><br>
                    <input type="text" class="form-control"id="author" name="author" value="<?= isset($postMethod) ? htmlentities($postMethod->getParameter('author')): ''; ?>"><br>
                    <?= isset($errors['author']) ? htmlentities($errors['author']) : ''; ?>
                    <label for="title">Titre</label><br>
                    <input type="text" class="form-control"id="title" name="title" value="<?= isset($postMethod) ? htmlentities($postMethod->getParameter('title')): ''; ?>"><br>
                    <?= isset($errors['title']) ? htmlentities($errors['title']) : ''; ?>
                    <label for="heading">Châpo</label><br>
                    <input type="text" class="form-control"id="heading" name="heading" value="<?= isset($postMethod) ? htmlentities($postMethod->getParameter('heading')): ''; ?>"><br>
                    <?= isset($errors['heading']) ? htmlentities($errors['heading']) : ''; ?>
                    <label for="content">Contenu</label><br>
                    <textarea class="form-control" rows="12" id="content" name="content"><?= isset($postMethod) ? htmlentities($postMethod->getParameter('content')): ''; ?></textarea><br>
                    <?= isset($errors['content']) ? htmlentities($errors['content']) : ''; ?>
                    <input type="submit" class="btn btn-primary"value="<?= htmlentities($submit); ?>" id="submit" name="submit">
                </div>
            </form> 
    </div>
</section>


