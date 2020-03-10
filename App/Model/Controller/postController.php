<?php
require '../elements/header.php';

if (!empty($_SERVER['REQUEST_URI'])) {
    require '../templates/post.php';
} else {
    echo '404';
}

require '../elements/footer.php';
