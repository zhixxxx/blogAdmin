<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    private $article;
    private $pageSize = 10;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function getList(Request $request)
    {
        $where = $request->input();
        $pageSize = $request->input('pageSize',$this->pageSize);

        $data = $this->article->paginate($pageSize);
        if($data){
            return $this->response_success($data);
        }
        return $this->response_fail('失败');
    }
}