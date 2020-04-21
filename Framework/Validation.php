<?php

namespace App\Framework;

class Validation 
{
    protected $errors= [];
   

    public function validate($data, $name)
    {
        $class = CONSTRAINT_PATH.$name.'Validation'; // i.e.: "UserValidation"
        $obj = lcfirst($name).'Validation';
        $obj = new $class;
        $errors = $obj->check($data);
        return $errors;
    }

    public function check(Method $postMethod)
    {
        foreach ($postMethod->allParameters() as $key => $value) {
            $this->checkField($key, $value);
        }
        return $this->errors;
    }

    protected function addError($name, $error) {
        if($error) {
            $this->errors += [
                $name => $error
            ];
        }
    }
}