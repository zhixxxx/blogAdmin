<?php

namespace App\Http\Controllers\Backend\Auth;

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
            return $this->response_fail('用户名和密码不能为空');
        }
        $data = auth('admin')->attempt([
            'username' => $params['username'],
            'password' => $params['password']
        ]);

        if(!$data){
            return $this->response_fail('用户名或密码错误');
        }
        return $this->response_success(['token'=>$data]);
    }

    public function getUserInfo()
    {
        $user_id = auth('admin')->id();
        $data = $this->user->select($this->user->field)->where('id',$user_id)->first();
        return $this->response_success($data);
    }
}
