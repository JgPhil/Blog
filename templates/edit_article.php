<?php $this->title = "Modifier l'article"; ?>
<h1>Mon blog</h1>
<p>Modifier l'article n°<?=$article->getId()?></p>

<div class="container">
    <div class="form-group col-sm-12">
        <form method="post" action="../public/index.php?route=editArticle&articleId=<?= htmlspecialchars($article->getId()); ?>">
            <label for="title">Titre</label><br>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($article->getTitle()); ?>"><br>
            <label for="title">Châpo</label><br>
            <input type="text" id="heading" name="heading" value="<?= htmlspecialchars($article->getHeading()); ?>"><br>
            <label for="content">Contenu</label><br>
            <textarea id="content" name="content"><?= htmlspecialchars($article->getContent()); ?></textarea><br>
            <label for="author">Auteur</label><br>
            <input type="text" id="author" name="author" value="<?= htmlspecialchars($article->getAuthor()); ?>"><br>
            <input type="submit" value="Mettre à jour" id="submit" name="submit">
        </form>
        <a href="../public/index.php">Retour à l'accueil</a>
    </div>
</div>