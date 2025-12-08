<?php

declare(strict_types=1);

namespace App\Account\Application\Exception;

class InvalidCredentialsException extends \Exception
{
    public function __construct()
    {
        //TODO: Translate key
        parent::__construct('Email or password is incorrect.');
    }
}