<?php

namespace App\src\controller;

class ErrorController extends BlogController
{
    public function errorNotFound()
    {
        return $this->view->render('error_404');
    }

    public function errorServer()
    {
        return $this->view->render('error_500');
    }
}