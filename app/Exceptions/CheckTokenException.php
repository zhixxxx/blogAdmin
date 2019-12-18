<?php

namespace App\Exceptions;

use App\Common\Code;

class CheckTokenException extends BaseException
{
    public function __construct()
    {
        $code = Code::CHECK_TOKEN_FAIL;
        $msg = Code::CHECK_TOKEN_FAIL_MSG;
        parent::__construct($msg,$code);
    }
}
