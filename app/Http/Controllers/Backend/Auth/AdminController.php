<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;

class AdminController extends Controller
{
    protected $user;

    public function __construct(AdminUser $user)
    {
        $this->user = $user;
    }

    public function Login()
    {
        return $this->response_success(2);
    }

    public function getUserInfo()
    {
        return $this->response_success('用户信息');
    }
}
