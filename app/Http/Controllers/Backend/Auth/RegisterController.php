<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;

class RegisterController extends Controller
{
    protected $user;

    public function __construct(AdminUser $user)
    {
        $this->user = $user;
    }

    public function create(){

    }
}
