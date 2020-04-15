<?php $this->title = "Connexion"; ?>
<h1>Mon blog</h1>
<p>En construction</p>
<?= $this->session->show('error_login');?>
<div>
    <form method="post" action="../public/index.php?route=login">
        <div class="form-group">
            <label for="pseudo">Pseudo</label><br>
            <input type="text" class="form-control" id="pseudo" name="pseudo"><br>
            <label for="password">Mot de passe</label><br>
            <input type="password" class="form-control" id="password" name="password"><br>
            <input type="submit" class="btn btn-primary" value="Connexion" id="submit" name="submit">
        </form>
        <a href="../public/index.php">Retour à l'accueil</a>
    </div>
</div>