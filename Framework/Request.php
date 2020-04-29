<?php

namespace App\Framework;

class Request
{
    protected $getMethod;
    protected $postMethod;
    protected $session;

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