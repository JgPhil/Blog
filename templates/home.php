<?php 
use App\src\constraint\Text;

$this->title = "Accueil"; ?>
    <h1>Mon blog</h1>
    <?= $this->session->show('register'); ?>
    <?= $this->session->show('login'); ?>
    <?= $this->session->show('logout'); ?>
    <?= $this->session->show('delete_account'); ?>

<?php
    if ($this->session->get('pseudo')) {
        ?>
        <a href="../public/index.php?route=logout">Déconnexion</a>
        <a href="../public/index.php?route=profile">Profil</a>
        <?php 
        if($this->session->get('role') === 'admin') {?>
        <a href="../public/index.php?route=administration">Administration</a>
        <?php 
        } 
    } else{
        ?>
        <a href="../public/index.php?route=register">Inscription</a>
        <a href="../public/index.php?route=login">Connexion</a> 
        <?php
    }
    ?>    

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
