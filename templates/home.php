<?php 
use App\src\helpers\Text;

$this->title = "Accueil"; ?>
    <h1>Mon blog</h1>
    <?= $this->session->show('edit_article'); ?>
    <?= $this->session->show('add_article'); ?>
    <a href="../public/index.php?route=addArticle">Ajouter un article</a>  
    
    
    <div class="row"> 

    <?php foreach($articles as $article)
    { 
        ?>
        <div class="class col-lg-4 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title"><a href="../public/index.php?route=article&articleId=<?= htmlspecialchars($article->getId());?>"><?= htmlspecialchars($article->getTitle());?></a></h2>
                <h4><?= htmlspecialchars($article->getHeading());?></h4>
                <p><?= htmlspecialchars(Text::excerpt($article->getContent()));?></p>
                <p><?= htmlspecialchars($article->getAuthor());?></p>
                <p>Créé le : <?= htmlspecialchars($article->getCreatedAt());?></p>
            </div>
        </div>
        </div>
        <br>
        <?php
    }
    ?>
    </div>
