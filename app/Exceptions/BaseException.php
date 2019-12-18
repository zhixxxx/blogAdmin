<?php

namespace App\Exceptions;

use App\Common\Response;
use Exception;

class BaseException extends Exception
{

    public function __construct(string $message = "", int $code = 0)
    {
        parent::__construct($message, $code);
    }

    public function render()
    {
        return Response::response_fail($this->message,$this->code);
    }
}
