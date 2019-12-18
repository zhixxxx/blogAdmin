<?php

namespace App\Http\Controllers\Backend;

use App\Common\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ArticleRequest;
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

    public function getList(ArticleRequest $request)
    {
        $where = $request->input();
        $pageSize = $request->input('pageSize',$this->pageSize);

        $data = $this->article->paginate($pageSize);
        if($data){
            return Response::response_success($data);
        }
        return Response::response_fail('失败');
    }

    public function save(ArticleRequest $request)
    {
        if($id = $request->input('id')){
            $this->article = $this->article->find($id);
        }
        $this->article->title = $request->input('title');
        $this->article->desc = $request->input('desc');
        $this->article->category_id = $request->input('category_id');
        $this->article->is_top = $request->input('is_top');
        $this->article->content = $request->input('content');
        $this->article->is_single = $request->input('is_single');
        if($this->article->is_single != 0){
            $this->article->images = $request->images;
        }
        $result = $this->article->save();
        if(!$result){
            return $this->response_fail('保存失败');
        }
        return Response::response_success();
    }

    public function info(Request $request)
    {
        $id = $request->input('id');

        $data = $this->article
            ->with(['category'=>function($sql){
                $sql->select('id','name');
            }])->find($id);
        return Response::response_success($data);
    }
}