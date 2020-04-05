<?php

$route = isset($postMethod) && $postMethod->getParameter('id')?'editComment':'addComment';
$submit = $route === 'addComment'?'Ajouter':'Mettre à jour';
?>


<form method="post" action="../public/index.php?route=addComment&postId=<?= htmlspecialchars($post->getId()); ?>">
    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo" value="<?=isset($postMethod)?htmlspecialchars($postMethod->getParameter('pseudo')): ''; ?>"><br>
    <?= isset($errors['pseudo']) ? $errors['pseudo'] : ''; ?>
    <label for="content">Message</label><br>
    <textarea id="content" name="content"><?= isset($postMethod) ? htmlspecialchars($postMethod->getParameter('content')): ''; ?></textarea><br>
    <?= isset($errors['content']) ? $errors['content'] : ''; ?>
    <input type="submit" value="<?= $submit ?>" id="submit" name="submit">
</form>