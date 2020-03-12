<?php

namespace App\Model;

class User
{
    const USERTYPE = [
        1 => 'Member',
        2 => 'Admin'
    ];

    //ATTRIBUTES CLASS

    protected $us_id,
              $username,
              $email,
              $pass,
              $userType,
              $dateCreation;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }         
                   

    //GETTERS

    public function id()
    {
        return $this->id;
    }
       
    public function username()
    {
        return $this->username;
    }
    
    public function  email()
    {
        return $this->email;
    }

    public function  password()
    {
        return $this->password;
    }

     public function  userType()
    {
        return $this->userType;
    }

    public function  dateCreation()
    {
        return $this->dateCreation;
    }


    //SETTERS

    public function setId($id)
    {
        if (is_int($this->id)){
            $this->id = $id;
        }
    }

    public function setUsername($username)
    {
        if (is_string($username) && strlen($username) <= 30){
            $this->username = $username; 
        }
        
    }

    public function setEmail($email)
    {
        if (is_string($email) && strlen($email) <= 30) {
            $this->_email = $email;
        }
    }

    public function setPassword($password)
    {
        if (is_string($password) && strlen($password) <= 100) {
            $this->_password = $password;
        }
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

        

