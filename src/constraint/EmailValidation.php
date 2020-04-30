<?php

namespace App\src\constraint;
use App\Framework\Method;

class EmailValidation extends BlogValidationComponent
{
    public function checkField($name, $value)
    {
        if($name === 'name') {
            $error = $this->checkName($name, $value);
            $this->addError($name, $error);
        }
        elseif ($name === 'email') {
            $error = $this->checkEmail($name, $value);
            $this->addError($name, $error);
        }
        elseif ($name === 'message') {
            $error = $this->checkMessage($name, $value);
            $this->addError($name, $error);
        }
        elseif ($name === 'phone') {
            $error = $this->checkPhone($name, $value);
            $this->addError($name, $error);
        }
    }

    private function checkName($name, $value)
    {
        if($this->constraint->blank($name, $value)) {
            return $this->constraint->blank('name', $value);
        }
        if($this->constraint->tooShort($name, $value, 2)) {
            return $this->constraint->tooShort('name', $value, 2);
        }
        if($this->constraint->tooLong($name, $value, 255)) {
            return $this->constraint->tooLong('name', $value, 255);
        }
    }

    private function checkEmail($name, $value)
    {
        if($this->constraint->blank($name, $value)) {
            return $this->constraint->blank('email', $value);
        }
        if($this->constraint->tooShort($name, $value, 2)) {
            return $this->constraint->tooShort('email', $value, 2);
        }
    }

    private function checkMessage($name, $value)
    {
        if($this->constraint->blank($name, $value)) {
            return $this->constraint->blank('message', $value);
        }
        if($this->constraint->tooShort($name, $value, 2)) {
            return $this->constraint->tooShort('message', $value, 2);
        }
        if($this->constraint->tooLong($name, $value, 255)) {
            return $this->constraint->tooLong('message', $value, 2047);
        }
    }

    private function checkPhone($name, $value)
    {
        if($this->constraint->blank($name, $value)) {
            return $this->constraint->blank('name', $value);
        }
        if($this->constraint->tooShort($name, $value, 9)) {
            return $this->constraint->tooShort('name', $value, 9);
        }
        if($this->constraint->tooLong($name, $value, 11)) {
            return $this->constraint->tooLong('name', $value, 11);
        }
    }
}