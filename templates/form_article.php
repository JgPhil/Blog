
<?php
/*
$route = isset($article) && $article->getId() ? 'editArticle&articleId='.$article->getId() : 'addArticle';
$submit = $route === 'addArticle' ? 'Envoyer' : 'Mettre à jour';
$title = isset($article) && $article->getTitle() ? htmlspecialchars($article->getTitle()) : '';
$heading = isset($article) && $article->getHeading() ? htmlspecialchars($article->getHeading()) : '';
$content = isset($article) && $article->getContent() ? htmlspecialchars($article->getContent()) : '';
$author = isset($article) && $article->getAuthor() ? htmlspecialchars($article->getAuthor()) : '';
?>


<div class="container">
    <div class="form-group col-sm-12">
        <form method="post" action="../public/index.php?route=<?=$route;?>">
            <label for="title">Titre</label><br>
            <input type="text" id="title" name="title" value="<?=$title;?>"><br>
            <label for="title">Châpo</label><br>
            <input type="text" id="heading" name="heading" value="<?=$heading;?>"><br>
            <label for="content">Contenu</label><br>
            <textarea id="content" name="content"><?=$content;?></textarea><br>
            <label for="author">Auteur</label><br>
            <input type="text" id="author" name="author" value="<?=$author;?>"><br>
            <input type="submit" value="<?=$submit;?>" id="submit" name="submit" class="btn btn-primary">
        </form>
        <a href="../public/index.php">Retour à l'accueil</a>
    </div>
</div>


<?php */

$route = isset($post) && $post->getParameter('id') ? 'editArticle&articleId='.$post->getParameter('id') : 'addArticle';
$submit = $route === 'addArticle' ? 'Envoyer' : 'Mettre à jour';
?>
<form method="post" action="../public/index.php?route=<?= $route; ?>">
    <label for="title">Titre</label><br>
    <input type="text" id="title" name="title" value="<?= isset($post) ? htmlspecialchars($post->getParameter('title')): ''; ?>"><br>
    <?= isset($errors['title']) ? $errors['title'] : ''; ?>
    <label for="heading">Châpo</label><br>
    <input type="text" id="heading" name="heading" value="<?= isset($post) ? htmlspecialchars($post->getParameter('heading')): ''; ?>"><br>
    <?= isset($errors['heading']) ? $errors['heading'] : ''; ?>
    <label for="content">Contenu</label><br>
    <textarea id="content" name="content"><?= isset($post) ? htmlspecialchars($post->getParameter('content')): ''; ?></textarea><br>
    <?= isset($errors['content']) ? $errors['content'] : ''; ?>
    <label for="author">Auteur</label><br>
    <input type="text" id="author" name="author" value="<?= isset($post) ? htmlspecialchars($post->getParameter('author')): ''; ?>"><br>
    <?= isset($errors['author']) ? $errors['author'] : ''; ?>
    <input type="submit" value="<?= $submit; ?>" id="submit" name="submit">
</form>