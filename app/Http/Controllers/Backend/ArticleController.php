<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{

    private $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function getList()
    {
        return $this->response_success($this->article->where('id',1)->first());
    }
}