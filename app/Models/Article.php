<?php

namespace App\Models;

class Article extends Model
{
    protected $table='article';
    public $status = [  //是否显示
        '1' => 1, //是
        '2' => 2  //否
    ];
    public $is_top = [  //是否置顶
        '1' => 1,   //是
        '2' => 2    //否
    ];
    public $is_admin = [    //是否后台发文
        '1' => 1,
        '2' => 2
    ];

    public function category(){
        return $this->hasMany(Category::class,'id','category_id');
    }
}