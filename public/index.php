<?php  

// routeur/Contrôleur frontal : instancie un routeur pour traiter la requête entrante
// Utilisation de l'autoloader de composer

require_once '../vendor/autoload.php';

use App\Framework\Router;


    $router = new Router;
    $router->route();




