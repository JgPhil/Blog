<?php

namespace App\config;

class Request
{
    private $getMethod;
    private $postMethod;
    private $session;

    public function __construct()
    {
        $this->getMethod = new Method($_GET);
        $this->postMethod = new Method($_POST);
        $this->session = new Session($_SESSION);
    }

    public function getGet()
    {
        return $this->getMethod;
    }

    public function getPost()
    {
        return $this->postMethod;
    }

    public function getSession()
    {
        return $this->session;
    }
}