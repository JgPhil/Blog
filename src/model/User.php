<?php

namespace App\src\model;

use App\src\DAO\userDAO;

class User
{
    private $id;
    private $pseudo;
    private $password;
    private $createdAt;
    private $role;
    private $activated;
    private $email;
    private $visible;
    private $erasedAt;
    private $pictureObj;
    private $picture;
    

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

    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
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

    public function getPictureObj()
    {
        $this->pictureObj = new UserDAO;
        return $this->pictureObj->getUserPicture($this->id);

    }

    public function getPicture()
    {
        if (empty($picture))
        {
            $this->picture = $this->getPictureObj($this->id);
            return $this->picture;
        }
    }
}