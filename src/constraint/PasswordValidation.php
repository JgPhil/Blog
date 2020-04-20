<?php

namespace App\src\constraint;
use App\Framework\Method;

class PasswordValidation extends Validation
{
    private $error;

    public function check($data)
    {
        $uppercase = preg_match('@[A-Z]@', $data);
        $lowercase = preg_match('@[a-z]@', $data);
        $number    = preg_match('@[0-9]@', $data);

        if(!$uppercase || !$lowercase || !$number || strlen($data) < 8) {
        return '<p>Le champ "Mot de passe" doit contenir au moins un chiffre, une majuscule et une minuscule.</p>';
        }
    }


}