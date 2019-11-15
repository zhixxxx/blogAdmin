<?php

namespace App\Models;

class AdminUser extends Model
{
    protected $table = 'admin_user';
    public $status = ['1'=>1,'2'=>2];//用户状态1=正常 2=禁止
}
