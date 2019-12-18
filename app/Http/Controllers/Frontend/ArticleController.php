<?php

namespace App\Http\Controllers\Frontend;

use App\Common\Response;
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
        $data = $this->article
            ->where('status',$this->article->status_field[1])
            ->orderBy('is_top','asc')
            ->orderBy('updated_at','desc')
            ->paginate(10);
        return Response::response_success($data);
    }
}
