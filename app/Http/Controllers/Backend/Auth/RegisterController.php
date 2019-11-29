<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UserRequest;
use App\Models\AdminUser;

class RegisterController extends Controller
{
    protected $user;

    public function __construct(AdminUser $user)
    {
        $this->user = $user;
    }

    public function create(UserRequest $request)
    {
        $params = $request->all();
        $this->user->username = $params['username'];
        $this->user->password = $params['password'];
        $this->user->last_time = date('Y-m-d H:i:s');
        $this->user->save();

        return $this->response_success();
    }
}
