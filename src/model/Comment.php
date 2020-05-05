<?php

namespace App\src\model;

use App\src\DAO\CommentDAO;

class Comment
{
    private $id;
    private $user_id;
    private $content;
    private $createdAt;
    private $post_id;
    private $validate;
    private $postObj; // Post Object refers to post_id.
    private $post = null;
    private $userObj;
    private $user = null;
    private $visible;
    private $erasedAt;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;
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

    public function getPost()
    {
        if (empty($post))
            {
               $this->post = $this->getPostObj($this->id);
            }
        return $this->post;
    }

    public function getUserObj()
    {
        $this->userObj = new CommentDAO;
        return $this->userObj->getUserFromComment($this->id);
    }

    public function getUser()
    {
        if (empty($user))
            {
               $this->user = $this->getUserObj($this->id);
            }
        return $this->user;
    }

    public function getVisible()
    {
        return $this->visible;
    }

    public function setVisible($visible)
    {
        $this->visible = $visible;
    }

    public function getErasedAt()
    {
        return $this->erasedAt;
    }

    public function setErasedAt($erasedAt)
    {
        $this->erasedAt = $erasedAt;
    }
}