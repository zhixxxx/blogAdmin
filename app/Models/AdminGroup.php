<?php

namespace App\Models;

class AdminGroup extends Model
{
    protected $table = 'admin_group';
    public $status = ['1'=>1,'2'=>2];      //是否启用 1=是 2=否
}
