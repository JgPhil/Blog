<?php

namespace App\Controller;

use App\Controller\PostController;
use App\Controller\HomeController;
use App\Controller\Error;

class Router
{
    public function route() {

        var_dump($_SERVER);

        if ($_SERVER['REQUEST_URI'] == '/') {
            $page = new HomeController;
            $page->render();
        }
        elseif ($_SERVER['REQUEST_URI'] == '/post') {
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