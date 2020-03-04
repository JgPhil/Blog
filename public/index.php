<?php 
require '../vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];
switch ($uri)
{
    case '/':
        require 'views/posts/index.php';
    break;
    case '/post':
        require 'views/post/post.php';
    break;
    default: echo "ERREUR 404";
}





