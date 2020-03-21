<?php

namespace App\Controller;

class Error
{
    public function render() {

        require '../elements/header.php';
        echo " <br><br><div class=\"container\">ERREUR 404  --- CETTE PAGE N'EXISTE PAS</div>";
        require '../elements/footer.php';
    }
}