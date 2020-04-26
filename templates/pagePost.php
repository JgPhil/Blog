<?php $this->title = "Article"; ?>

<!-- page title -->
<section class="page-title bg-primary position-relative">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="text-white font-tertiary">Blog</h1>
      </div>
    </div>
  </div>
  <!-- background shapes -->
  <img src="images/illustrations/page-title.png" alt="illustrations" class="bg-shape-1 w-100">
  <img src="images/illustrations/leaf-pink-round.png" alt="illustrations" class="bg-shape-2">
  <img src="images/illustrations/dots-cyan.png" alt="illustrations" class="bg-shape-3">
  <img src="images/illustrations/leaf-orange.png" alt="illustrations" class="bg-shape-4">
  <img src="images/illustrations/leaf-yellow.png" alt="illustrations" class="bg-shape-5">
  <img src="images/illustrations/dots-group-cyan.png" alt="illustrations" class="bg-shape-6">
  <img src="images/illustrations/leaf-cyan-lg.png" alt="illustrations" class="bg-shape-7">
</section>
<!-- /page title -->



<section class="section">
  <div class="container">
      <div>
          <p><a href="../public/index.php" ><i class="fas fa-long-arrow-alt-left"></i>  Retour à l'accueil</a></p>
      </div>
    <div class="row">
      <div class="col-lg-12">
        <h3 class="font-tertiary mb-4"><?= htmlspecialchars($post->getTitle());?></h3>
        <h4 class="font-tertiary mb-2"><?= htmlspecialchars($post->getHeading());?></h4>
        <p class="font-secondary">Publié le <?= htmlspecialchars($post->getCreatedAt());?> par <span class="text-primary"><?= htmlspecialchars($post->getAuthor());?></span></p>
        <div class="content">
          <img src="images/blog/post-1.jpg" alt="post-thumb" class="img-fluid rounded float-left mr-5 mb-4">
          <strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
            et dolore magna aliqua.  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
            mollit anim id est laborum.</strong>
          <p><?= htmlspecialchars($post->getContent());?></p>
        </div>
      </div>
    </div>
  </div>
</section>



<section>
    <div class="container">
        <div class="row">
        <div class="col-lg-12">
            <h4 class="font-weight-bold mb-3">Commentaires</h4>

        <?php
        foreach ($comments as $comment)
        {
        ?>
            <div class="bg-gray p-4 mb-4">
                <div class="media border-bottom py-2">
                    <img src="images/user-1.jpg" class="img-fluid align-self-start rounded-circle mr-3" alt="">
                    <div class="media-body">
                        <h5 class="mt-0"><?= htmlspecialchars($comment->getPseudo());?></h5>
                        <p><?= htmlspecialchars($comment->getCreatedAt());?></p>
                        <p><?= htmlspecialchars($comment->getContent());?></p>
                    </div>
                </div>
            </div>

        <?php
        }
        
        if ($this->session->get('pseudo')) //si l'utilisateur est connecté avec un compte validé Alors on affiche le formulaire commentaire
        {
            if ($this->session->get('add_comment'))
            {
            ?>    
                <div class="alert alert-success" role="alert"><?= $this->session->show('add_comment'); ?></div>
            <?php    
            }
            ?>    
            <h4 >Laissez un commentaire</h4>
            <form method="post" action=<?=INDEX_PATH.SLUG."addComment&postId=".htmlspecialchars($post->getId()); ?> class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control mb-3" placeholder="First Name" name="pseudo" id="pseudo"value="<?=$this->session->get('pseudo'); ?> " readonly>
                </div>
                <div class="col-md-6">
                <?php
                if (isset($errors['content']))
                {
                ?>    
                    <div class="alert alert-danger" role="alert"><?= $errors['content']; ?></div>
                <?php    
                }
                ?>    
                    <textarea name="content" id="content" placeholder="Message" class="form-control mb-4"></textarea>                    
                    <input type="submit" class="btn btn-primary w-100" id="submit" value="Soumettre" name="submit" />
                </div>
            </form>
        <?php
        }
        else 
        {
        ?>
            <h4 class="font-weight-bold mb-3 border-bottom pb-3">Merci de vous inscrire si vous souhaitez laisser un commentaire.</h4>
        <?php
        }
        ?>
                </div>
            </div>
        </div>
</section>