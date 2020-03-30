<?php $this->title = "Accueil"; ?>
    <h1>Mon blog</h1>

    <?php
    
    foreach($articles as $article)
    { 
        ?>
        <div class="card">
            <div class="card-body">
                <h2 class="card-title"><a href="../public/index.php?route=article&articleId=<?= htmlspecialchars($article->getId());?>"><?= htmlspecialchars($article->getTitle());?></a></h2>
                <h4><?= htmlspecialchars($article->getHeading());?></h4>
                <p><?= htmlspecialchars($article->getContent());?></p>
                <p><?= htmlspecialchars($article->getAuthor());?></p>
                <p>Créé le : <?= htmlspecialchars($article->getCreatedAt());?></p>
            </div>
        </div>
        <br>
        <?php
    }
    ?>
