<?php

namespace App\src\model;

use App\src\DAO\PostDAO;

class Post
{
    private $id;
    private $title;
    private $content;
    private $heading;
    private $author;
    private $createdAt;
    private $userObj;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }


    public function setTitle($title)
    {
        $this->title = $title;
    }


    public function getHeading()
    {
        return $this->heading;
    }

    public function setHeading($heading)
    {
        $this->heading = $heading;
    }
    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getUserObj()
    {
        $this->userObj = new PostDAO ; // Instanciation de la classe UserDAO, puis appel de la ...
        return $this->userObj->getUserFromPost($this->id); // ...méthode getUserFromPost() qui retourne un objet "User"
    }
}