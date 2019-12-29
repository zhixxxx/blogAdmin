<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/26
 * Time: 15:05
 */

namespace App\Models;


class ArticleLabel extends Model
{
    protected $table = 'article_label';

    protected $fillable = ['article_id','label_id','created_at','updated_at'];
}