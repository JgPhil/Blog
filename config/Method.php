<?php

namespace App\config;

class Method
{
    private $method;

    public function __construct($method)
    {
        $this->method = $method;
    }

    public function getParameter($name)
    {
        if(isset($this->method[$name]))
        {
            return $this->method[$name];
        }
    }

    public function setParameter($name, $value)
    {
        $this->method[$name] = $value;
    }
    
    public function allParameters()
    {
        return $this->method;
    }

}