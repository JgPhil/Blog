<?php

namespace App\src\constraint;

class Constraint
{
    

    public function blank($name, $value)
    {
        if(empty($value)) {
            return '<p>Le champ '.$name.' saisi est vide</p>';
        }
    }
    public function tooShort($name, $value, $minSize)
    {
        if(strlen($value) < $minSize) {
            return '<p>Le champ '.$name.' doit contenir au moins '.$minSize.' caractères</p>';
        }
    }
    public function tooLong($name, $value, $maxSize)
    {
        if(strlen($value) > $maxSize) {
            return '<p>Le champ '.$name.' doit contenir au maximum '.$maxSize.' caractères</p>';
        }
    }

    public function weakPassword($name, $value)
    {
        $uppercase = preg_match('@[A-Z]@', $value);
        $lowercase = preg_match('@[a-z]@', $value);
        $number    = preg_match('@[0-9]@', $value);

        if(!$uppercase || !$lowercase || !$number || strlen($value) < 4 || strlen($value) > 255) {
            return '<p>Le champ "Mot de passe" doit contenir au moins 8 caractères, dont:  au moins un chiffre, une majuscule et une minuscule.</p>';
        }
    }
}