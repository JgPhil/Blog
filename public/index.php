<?php  //routeur

require '../vendor/autoload.php';
use App\Controller\Router;

if (!empty($_SERVER['REQUEST_URI']))
{
    $router = new Router;
    $router->route();
}



