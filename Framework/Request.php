<?php

namespace App\Framework;

class Request
{
    protected $getMethod;
    protected $postMethod;
    protected $session;
    protected $_SESSION;
    protected $_POST;
    protected $_GET;

    public function __construct()
    {
        $this->_POST = (isset($_POST)) ? $_POST : null;
        $this->_GET = (isset($_GET)) ? $_GET : null;
        $this->_SESSION = (isset($_SESSION)) ? $_SESSION : null;
        $this->getMethod = new Method($this->_GET);
        $this->postMethod = new Method($this->_POST);
        $this->session = new Session($this->_SESSION);
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