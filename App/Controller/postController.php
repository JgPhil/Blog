<?php
namespace App\Controller;
require '../elements/header.php';

if (!empty($_SERVER['REQUEST_URI'])) {
    require 'Templates/post.php';
} else {
    echo '404';
}

require '../elements/footer.php';
