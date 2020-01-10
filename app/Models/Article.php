<?php

namespace App\Models;

class Article extends Model
{
    protected $table='article';

    public $status_field = [  //是否显示
        '1' => 1, //是
        '2' => 2  //否
    ];
    public $is_top_field = [  //是否置顶
        '1' => 1,   //是
        '2' => 2    //否
    ];
    public $is_admin_field = [    //是否后台发文
        '1' => 1,
        '2' => 2
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function label()
    {
        return $this->belongsToMany(Label::class,'article_label','article_id','label_id');
    }
}