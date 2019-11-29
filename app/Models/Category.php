<?php

namespace App\Models;


class Category extends Model
{
    protected $table = 'category';

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['id','name','pid','created_at','updated_at'];
}
