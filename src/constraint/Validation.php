<?php

namespace App\src\constraint;

class Validation
{
    public function validate($data, $name)
    {
        if($name === 'Post') {
            $postValidation = new PostValidation();
            $errors = $postValidation->check($data);
            return $errors;
        }
        elseif ($name === 'Comment') {
            $commentValidation = new CommentValidation();
            $errors = $commentValidation->check($data);
            return $errors;
        }
    }
}