<?php

namespace App\Common;

class Response
{

    public static function response_success($data = [],$code = Code::SUCCESS,$message = Code::SUCCESS_MSG)
    {
        return self::resultJson($code,$message,$data);
    }

    public static function response_fail($message = Code::FAIL_MSG,$code = Code::FAIL)
    {
        return self::resultJson($code,$message);
    }

    public static function resultJson($code = Code::FAIL,$message = '',$data = [])
    {
        return response()
            ->json([
                'code' => $code,
                'message' => $message,
                'data' => $data
            ]);
    }
}