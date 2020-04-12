<?php

$route = isset($postMethod) && $postMethod->getParameter('id')?'editComment':'addComment';
?>


<form method="post" action="../public/index.php?route=addComment&postId=<?= htmlspecialchars($post->getId()); ?>">
    <div class="form-group">
        <label for="pseudo">Pseudo</label><br>
        <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?=$this->session->get('pseudo'); ?> " readonly><br>
        <?= isset($errors['pseudo']) ? $errors['pseudo'] : ''; ?>
        <label for="content">Message</label><br>
        <textarea class="form-control" id="content" name="content"></textarea><br>
        <?= isset($errors['content']) ? $errors['content'] : ''; ?>
        <input type="submit" class="btn btn-primary" value="Soumettre" id="submit" name="submit">
    </div>   
</form>