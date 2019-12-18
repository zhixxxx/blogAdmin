<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Common\Response;
use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $user;

    public function __construct(AdminUser $user)
    {
        $this->user = $user;
    }

    public function Login(Request $request)
    {
        $params = $request->all();
        if(empty($params['username']) || empty($params['password'])){
            return Response::response_fail('用户名和密码不能为空');
        }
        $data = auth('admin')->attempt([
            'username' => $params['username'],
            'password' => $params['password']
        ]);

        if(!$data){
            return Response::response_fail('用户名或密码错误');
        }

        $user_id = auth('admin')->id();

        $userInfo = $this->user
            ->select('id','username','password','nickname','avatar','phone',
                'email','last_time','last_ip','status','created_at','updated_at')
            ->where('id',$user_id)
            ->first();

        $userInfo['token'] = $data;
        return Response::response_success($userInfo);
    }

    public function getUserInfo()
    {
        $user_id = auth('admin')->id();
        $data = $this->user
            ->select('id','username','password','nickname','avatar','phone',
                'email','last_time','last_ip','status','created_at','updated_at')
            ->where('id',$user_id)
            ->first();
        return Response::response_success($data);
    }

    public function logout()
    {
//        auth('admin')->logout();
        Auth::logout();
        return Response::response_success();
    }
}
