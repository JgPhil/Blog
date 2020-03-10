<?php 
require '../vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];

require '../elements/header.php';

switch ($uri) {
    case '/': 
        require '../templates/home.php';
    break;
    case '/contact':
        require '../templates/contact.php';
    break;
    case '/post':
        require '../templates/post.php';
    break;
    default: echo 'ERREUR 404';
    require '../elements/footer.php';   
}





