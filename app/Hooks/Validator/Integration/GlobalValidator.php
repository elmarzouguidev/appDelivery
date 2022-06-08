<?php


namespace App\Hooks\Validator\Integration;

use App\Hooks\Validator\Repository\HooksValidation;

class GlobalValidator extends HooksValidation
{

    public function __construct()
    {
        $this->state = true;
    }
}
