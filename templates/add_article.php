<?php $this->title = "Nouvel article"; ?>
<h1>Mon blog</h1>
<p>Ajout d'un nouvel article</p>

<div class="container"></div>
    <div class="form-group">
        <form method="post" action="../public/index.php?route=addArticle">
            <label for="title">Titre</label><br>
            <input type="text" class="form_control mb-2" id="title" name="title" placeholder="Entrez le titre"><br>
            <label for="heading">châpo</label><br>
            <input type="text" class="form_control mb-2" id="heading" name="heading" placeholder="Entrez le châpo"><br>
            <label for="content">Contenu</label><br>
            <textarea id="content" class="form_control mb-2" name="content" placeholder="Entrez le contenu de l'article"></textarea><br>
            <label for="author">Auteur</label><br>
            <input type="text" class="form_control mb-4" id="author" name="author" placeholder="Entrez l'auteur"><br>
            <input type="submit" class="btn btn-primary" value="Envoyer" id="submit" name="submit">
        </form>
    </div>
    <a href="../public/index.php">Retour à l'accueil</a>
</div>    
    
 