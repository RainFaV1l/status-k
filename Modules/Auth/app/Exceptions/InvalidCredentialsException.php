<?php

namespace Modules\Auth\Exceptions;

use Exception;

class InvalidCredentialsException extends Exception
{
    public function __construct(string $message = "Invalid credentials", int $code = 401)
    {
        parent::__construct($message, $code);
    }
}
