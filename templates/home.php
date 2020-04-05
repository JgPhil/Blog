<?php 
use App\src\helpers\Text;

$this->title = "Accueil"; ?>
    <h1>Mon blog</h1>
    <?= $this->session->show('edit_post'); ?>
    <?= $this->session->show('add_post'); ?>
    <?= $this->session->show('delete_post'); ?>
    <?= $this->session->show('add_comment');?>
   
    <a href="../public/index.php?route=addPost">Ajouter un article</a>  
    
    
    <div class="row"> 

    <?php foreach($posts as $post)
    { 
        ?>
        <div class="class col-lg-4 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title"><a href="../public/index.php?route=post&postId=<?= htmlspecialchars($post->getId());?>"><?= htmlspecialchars($post->getTitle());?></a></h2>
                <h4><?= htmlspecialchars($post->getHeading());?></h4>
                <p><?= htmlspecialchars(Text::excerpt($post->getContent()));?></p>
                <p><?= htmlspecialchars($post->getAuthor());?></p>
                <p>Créé le : <?= htmlspecialchars($post->getCreatedAt());?></p>
            </div>
        </div>
        </div>
        <br>
        <?php
    }
    ?>
    </div>
