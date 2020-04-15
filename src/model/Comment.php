<?php

namespace App\src\model;

use App\src\DAO\CommentDAO;

class Comment
{
    private $id;
    private $pseudo;
    private $content;
    private $createdAt;
    private $post_id;
    private $validate;
    private $postObj; // Post Object refers to post_id.
   

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
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getPost_id()
    {
        return $this->post_id;
    }

    public function setPost_id($post_id)
    {
        $this->post_id = $post_id;
    }

    public function getValidate()
    {
        return $this->validate;
    }
    public function setValidate($validate)
    {
        $this->validate= $validate;
    }

    public function getPostObj()
    {
        $this->postObj = new CommentDAO ; // Instanciation de la classe CommentDAO, puis appel de la ...
        return $this->postObj->getPostFromComment($this->id); // ...méthode getPostFromComment() qui retourne un objet "Post"
    }

   
}