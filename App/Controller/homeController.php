<?php
require '../elements/header.php';

if (!empty($_SERVER['REQUEST_URI'])) {
    require '../Templates/home.php';
} else {
    echo '404';
}

require '../elements/footer.php';
