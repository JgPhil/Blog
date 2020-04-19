<?php

namespace App\src\constraint;
use App\Framework\Method;

class CommentValidation extends Validation
{

    private $errors= [];
    private $constraint;

    public function __construct()
    {
        $this->constraint = new Constraint;
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
        if($name === 'pseudo') {
            $error = $this->checkPseudo($name, $value);
            $this->addError($name, $error);
        }
        elseif ($name === 'content') {
            $error = $this->checkContent($name, $value);
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

    private function checkContent($name, $value)
    {
        if($this->constraint->blank($name, $value)) {
            return $this->constraint->blank('content', $value);
        }
        if($this->constraint->tooShort($name, $value, 2)) {
            return $this->constraint->tooShort('content', $value, 2);
        }
    }
}
