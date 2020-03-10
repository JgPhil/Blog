<?php
require '../elements/header.php';

if (!empty($_SERVER['REQUEST_URI'])) {
    require '../templates/home.php';
} else {
    echo '404';
}

require '../elements/footer.php';
