<?php

namespace App\Http\Controllers\Backend\System;


use App\Common\Response;
use App\Http\Controllers\Controller;
use App\Models\AdminUser;

class AdminUserController extends Controller
{
    protected $user;

    public function __construct(AdminUser $user)
    {
        $this->user = $user;
    }

    public function getAdminUserList()
    {
        $data = $this->user->get();
        return Response::response_success($data);
    }

}