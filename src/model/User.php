<?php

namespace App\src\model;

class User
{
    private $id;
    private $pseudo;
    private $password;
    private $createdAt;
    private $role;
    private $activated;
    private $token;
    private $tokenTimeOut;

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

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getRole() 
    {
        return $this->role;
    }
    
    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getActivated()
    {
        return $this->activated;
    }
    
    public function setActivated($activated)
    {
        $this->activated = $activated;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getTokenTimeOut()
    {
        return $this->tokenTimeOut;
    }

    public function setTokenTimeOut($tokenTimeOut)
    {
        $this->tokenTimeOut = $tokenTimeOut;
    }
}