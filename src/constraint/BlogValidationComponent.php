<?php

namespace App\src\constraint;

use App\Framework\Validation;

class BlogValidationComponent extends Validation
{
    protected $constraint;

    public function __construct()
    {
        $this->constraint = new Constraint;
    }
}