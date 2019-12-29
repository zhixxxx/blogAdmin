<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/26
 * Time: 15:00
 */

namespace App\Models;


class Label extends Model
{
    protected $table = 'label';

    protected $fillable = ['name','status','created_at','updated_at'];
}