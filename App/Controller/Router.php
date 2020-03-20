<?php

namespace App\Controller;

use App\Controller\PostController;
use App\Controller\HomeController;
use App\Controller\Error;

class Router
{
    public function route() {

        $uri = $_SERVER['REQUEST_URI'];

        var_dump($uri);

        if ($uri == '/') {
            $page = new HomeController;
            $page->render();
        }
        elseif ($uri == '/post') {
            $page = new PostController;
            $page->render();           
        }
        else {  
            $page = new Error;
            $page->render();
        }
        return $page;
    }
}