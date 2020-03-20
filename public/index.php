<?php  //routeur

require '../vendor/autoload.php';
use App\Controller\Router;

if (!empty($_SERVER['REQUEST_URI']))
{
    $route = new Router;
    $route->route();
}



