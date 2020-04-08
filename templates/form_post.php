

<?php
$route = isset($postMethod) && $postMethod->getParameter('id') ? 'editPost&postId='.$postMethod->getParameter('id') : 'addPost';
$submit = $route === 'addPost' ? 'Envoyer' : 'Mettre à jour';
?>

<form method="post" action="../public/index.php?route=<?= $route; ?>">
    <div class="form-group">
        <label for="title">Titre</label><br>
        <input type="text" class="form-control"id="title" name="title" value="<?= isset($postMethod) ? htmlspecialchars($postMethod->getParameter('title')): ''; ?>"><br>
        <?= isset($errors['title']) ? $errors['title'] : ''; ?>
        <label for="heading">Châpo</label><br>
        <input type="text" class="form-control"id="heading" name="heading" value="<?= isset($postMethod) ? htmlspecialchars($postMethod->getParameter('heading')): ''; ?>"><br>
        <?= isset($errors['heading']) ? $errors['heading'] : ''; ?>
        <label for="content">Contenu</label><br>
        <textarea class="form-control" rows="12" id="content" name="content"><?= isset($postMethod) ? htmlspecialchars($postMethod->getParameter('content')): ''; ?></textarea><br>
        <?= isset($errors['content']) ? $errors['content'] : ''; ?>
        <input type="submit" class="btn btn-primary"value="<?= $submit; ?>" id="submit" name="submit">
    </div>
</form>

