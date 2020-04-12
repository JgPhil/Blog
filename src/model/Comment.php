<?php

namespace App\src\model;

class Comment
{
    private $id;
    private $pseudo;
    private $content;
    private $createdAt;
    private $post_id;
    private $validate;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

     public function getCreatedAt()
    {
        $createdAt = new \DateTime;
        return $createdAt->format('d-m-Y à H:i:s');
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getPost_id()
    {
        return $this->createdAt;
    }

    public function setPost_id($post_id)
    {
        $this->post_id = $post_id;
    }

    public function getValidate()
    {
        return $this->validate;
    }

   
}