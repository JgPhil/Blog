<?php

namespace App\src\constraint;
use App\Framework\Method;

class UserValidation extends BlogValidationComponent
{

    public function checkField($name, $value)
    {        
        if($name === 'pseudo') {
            $error = $this->checkPseudo($name, $value);
            $this->addError($name, $error);
        }
        elseif ($name === 'password') {
            $error = $this->checkPassword($name, $value);
            $this->addError($name, $error);
        }
    }

    private function checkPseudo($name, $value)
    {
        if($this->constraint->blank($name, $value)) {
            return $this->constraint->blank('pseudo', $value);
        }
        if($this->constraint->tooShort($name, $value, 2)) {
            return $this->constraint->tooShort('pseudo', $value, 2);
        }
        if($this->constraint->tooLong($name, $value, 255)) {
            return $this->constraint->tooLong('pseudo', $value, 255);
        }
    }

    private function checkPassword($name, $value)
    {        
        if($this->constraint->blank($name, $value)) {
            return $this->constraint->blank('password', $value);
        }
        if($this->constraint->tooShort($name, $value, 2)) {
            return $this->constraint->tooShort('password', $value, 2);
        }
        if($this->constraint->tooLong($name, $value, 255)) {
            return $this->constraint->tooLong('password', $value, 255);
        }
        if($this->constraint->weakPassword($name, $value)) {
            return $this->constraint->weakPassword($name, $value);
        }
    }
}