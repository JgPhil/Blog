<?php


class User
{
    const USERTYPE = [
        1 => 'Member',
        2 => 'Admin'
    ];

    //ATTRIBUTES CLASS

    private $id;
    private $username;
    private $email;
    private $pass;
    private $activated;
    private $validationKey;
    private $userType;
    private $dateCreation;

    //SETTERS

    public function getId()
    {
        return $this->id;
    }
       
    public function getUsername()
    {
        return $this->username;
    }
    
    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

     public function getUserType()
    {
        return $this->userType;
    }

    public function getDateCreation()
    {
        return $this->dateCreation;
    }


    //SETTERS

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setActivated($activated)
    {
        $this->activated = $activated;
    }

    public function setValidationKey($validationKey)
    {
        $this->validationKey = $validationKey;
    }

    public function setUserType($userType)
    {
        $this->userType = $userType;
    }

    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

}

        

