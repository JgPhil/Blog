<?php

namespace App\Framework;

abstract class Controller
{
    protected $view;
    protected $request;
    protected $getMethod;
    protected $postMethod;
    protected $session;
   
    

    public function __construct()
    {
        $this->view = new View;
        $this->request = new Request;
        $this->getMethod = $this->request->getGet();
        $this->postMethod = $this->request->getPost();
        $this->session = $this->request->getSession();
    }
}