<?php

namespace App\Framework;
use App\src\DAO\CommentDAO;
use App\src\DAO\PostDAO;
use App\src\DAO\UserDAO;

 class DAOComponent extends DAO
{
    private $commentDAO;
    private $postDAO;
    private $userDAO;

    public function __construct()
    {
        $this->commentDAO = new CommentDAO;
        $this->postDAO = new postDAO;
        $this->userDAO = new userDAO;
    }


}