<?php

namespace App\Model;

class User
{
    const USERTYPE = [
        1 => 'Member',
        2 => 'Admin'
    ];

    //ATTRIBUTES CLASS

    protected $user_id,
              $username,
              $email,
              $password,
              $role_id,
              $creation_date;

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

    public function user_id()
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

     public function  role_id()
    {
        return $this->role_id;
    }

    public function  creation_date()
    {
        return $this->creation_date;
    }


    //SETTERS

    public function setUser_id($user_id)
    {
        if (is_int($this->user_id)){
            $this->user_id = $user_id;
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
            $this->email = $email;
        }
    }

    public function setPassword($password)
    {
        if (is_string($password) && strlen($password) <= 100) {
            $this->password = $password;
        }
    }
    

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }

}

        

