<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use \Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class AdminUser extends Authenticatable implements JWTSubject
{
    use Notifiable;


    protected $table = 'admin_user';
    public $status = ['1'=>1,'2'=>2];//用户状态1=正常 2=禁止

    //数据库可查字段
    public $field = [
        'id',
        'username',
        'password',
        'nickname',
        'avatar',
        'phone',
        'email',
        'last_time',
        'last_ip',
        'status',
        'created_at',
        'updated_at'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    //将密码进行加密
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
