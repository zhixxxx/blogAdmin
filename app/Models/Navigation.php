<?php

namespace App\Models;


class Navigation extends Model
{
    protected $table = 'navigation';

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['name','pid','created_at','updated_at'];
}
