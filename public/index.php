<?php 
require '../vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];
$router = new AltoRouter();
$router->map('GET','/', 'home');
// gestion URL avec parametres
$router->map('GET','/post/[*:slug]-[i:id]', function ($slug, $id){
    echo "Vous êtes sur l'article $slug avec le numéro $id";
});
$match = $router->match();
if ($match !== null) {
    require '../elements/header.php';

    if (is_callable($match['target'])) {
        call_user_func_array($match['target'],$match['params']);
    } else {
        var_dump($match);
        $params = $match['params'];
        require "../templates/'{$match['target']}.php";
    }
    
    require '../elements/header.php';
} 
/*
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





