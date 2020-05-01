<?php

use App\Framework\NewRouter;

require '../vendor/autoload.php';

session_start();
$router = new NewRouter;
$router->run();
