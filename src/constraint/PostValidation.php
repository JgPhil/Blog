<?php

namespace App\src\constraint;
use App\Framework\Method;

class PostValidation extends Validation
{
    private $errors = [];
    private $constraint;

    public function __construct()
    {
        $this->constraint = new Constraint();
    }

    public function check(Method $postMethod)
    {
        foreach ($postMethod->allParameters() as $key => $value) {
            $this->checkField($key, $value);
        }
        return $this->errors;
    }

    private function checkField($name, $value)
    {
        if($name === 'title') {
            $error = $this->checkTitle($name, $value);
            $this->addError($name, $error);
        }
        elseif ($name === 'content') {
            $error = $this->checkContent($name, $value);
            $this->addError($name, $error);
        }
        elseif ($name === 'heading') {
            $error = $this->checkHeading($name, $value);
            $this->addError($name, $error);
        }
    }

    private function addError($name, $error) {
        if($error) {
            $this->errors += [
                $name => $error
            ];
        }
    }

    private function checkTitle($name, $value)
    {
        if($this->constraint->blank($name, $value)) {
            return $this->constraint->blank('titre', $value);
        }
        if($this->constraint->tooShort($name, $value, 2)) {
            return $this->constraint->tooShort('titre', $value, 2);
        }
        if($this->constraint->tooLong($name, $value, 255)) {
            return $this->constraint->tooLong('titre', $value, 255);
        }
    }

    private function checkContent($name, $value)
    {
        if($this->constraint->blank($name, $value)) {
            return $this->constraint->blank('contenu', $value);
        }
        if($this->constraint->tooShort($name, $value, 2)) {
            return $this->constraint->tooShort('contenu', $value, 2);
        }
    }

    private function checkHeading($name, $value)
    {
        if($this->constraint->blank($name, $value)) {
            return $this->constraint->blank('châpo', $value);
        }
        if($this->constraint->tooShort($name, $value, 2)) {
            return $this->constraint->tooShort('châpo', $value, 2);
        }
        if($this->constraint->tooLong($name, $value, 255)) {
            return $this->constraint->tooLong('châpo', $value, 255);
        }
    }
}