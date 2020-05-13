<?php

namespace App\Framework;

/**
 * Class Controller
 */
abstract class Controller
{
    protected $view;
    protected $request;
    protected $getMethod;
    protected $postMethod;
    protected $session;
   
    

    /**
     * @return void
     */
    public function __construct()
    {
        $this->view = new View;
        $this->request = new Request;
        $this->getMethod = $this->request->getGet();
        $this->postMethod = $this->request->getPost();
        $this->session = $this->request->getSession();
    }
}