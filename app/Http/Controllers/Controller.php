<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function response_success($data = [],$code = 200,$message = '')
    {
        return $this->resultJson($code,$message,$data);
    }

    protected function response_fail($message = '',$code = 1)
    {
        return $this->resultJson($code,$message);
    }

    protected function resultJson($code = 1,$message = '',$data = [])
    {
        return json_encode(['code'=>$code,'message'=>$message,'data'=>[$data]]);
    }
}
