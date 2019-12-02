<?php

namespace App\Models;

class AdminRule extends Model
{
    protected $table = 'admin_rule';
    public $status_field = ['1'=>1,'2'=>2];  //1=启用 2=禁用
}
