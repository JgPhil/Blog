<?php

namespace App\src\controller;

use App\src\DAO\PostDAO;
use App\src\DAO\CommentDAO;
use App\src\constraint\Validation;
use App\src\model\View;
use App\config\Request;


abstract class Controller
{
    protected $postDAO;
    protected $commentDAO;
    protected $view;
    private $request;
    protected $getMethod;
    protected $postMethod;
    protected $session;
    protected $validation;

    public function __construct()
    {
        $this->postDAO = new PostDAO;
        $this->commentDAO = new CommentDAO;
        $this->view = new View;
        $this->validation = new Validation;
        $this->request = new Request;
        $this->getMethod = $this->request->getGet();
        $this->postMethod = $this->request->getPost();
        $this->session = $this->request->getSession();
    }
}