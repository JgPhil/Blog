<?php $this->title = 'Modifier mon image'; ?>

<!-- page title -->
<section class="page-title bg-primary position-relative">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="text-white font-tertiary">Modifier mon image</h2>
            </div>
        </div>
    </div>
</section>
<!-- /page title -->



<div class="section">
    <div class="row">
        <div class="container">

            <div class="col-lg-4">
                <p><a href=<?= SLUG . "profile" ?>><i class="fas fa-long-arrow-alt-left"></i> Retour à mon espace personnel</a></p>
            </div>
            <div class="col-md-4">

            </div>
            <form method="post" enctype="multipart/form-data" action="<?="../public/index.php?route=update_user_picture&userId=".htmlentities($postMethod->getParameter('userId'))?>">
                <div class="form-group">
                    
                    <p><b>Image actuelle: </b><em><?= isset($postMethod) ? htmlentities($postMethod->getParameter('picturePath')) : ''; ?></em></p>
                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                    <input name="userfile" class="form-control" type="file" />

                    <input type="submit" class="btn btn-primary" value="Metttre à jour" id="submit" name="submit">
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<div>



</div>