<?php  //routeur

require '../vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];


switch ($uri) {
    case '/': 
        require '../App/Controller/homeController.php';
    break;
    case '/post':
        require '../App/Controller/postController.php';
    break;
    case '/contact':
        require '../templates/contact.php';
    break;
    
    default: echo 'ERREUR 404';
 
}





