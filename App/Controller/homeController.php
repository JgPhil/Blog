<?php
require '../elements/header.php';

if (!empty($_SERVER['REQUEST_URI'])) {
    require '../Templates/home.php';
    var_dump($SERVER);
} else {
    echo '404';
}

require '../elements/footer.php';
