<?php

namespace App\Http\Controllers\Backend;

use App\Common\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ArticleRequest;
use App\Models\Article;
use App\Models\ArticleLabel;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{

    private $article;
    private $pageSize = 10;
    private $label;
    private $articleLabel;

    public function __construct(Article $article, Label $label, ArticleLabel $articleLabel)
    {
        $this->article = $article;
        $this->label = $label;
        $this->articleLabel = $articleLabel;
    }

    /**
     * 文章列表
     * @param ArticleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(ArticleRequest $request)
    {
        $search = $request->input('title','');
        $pageSize = $request->input('pageSize',$this->pageSize);

        $data = $this->article
            ->where( function($sql) use ($search) {
                if (!empty($search)) {
                    $sql->where('title','like','%'.$search.'%');
                }
            })
            ->paginate($pageSize);
        if($data){
            return Response::response_success($data);
        }
        return Response::response_fail('失败');
    }

    /**
     * 修改、添加文章
     * @param ArticleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(ArticleRequest $request)
    {
        $id = $request->input('id','');

        if(!empty($id)){
            $this->article = $this->article->find($id);
        }
        $this->article->title = $request->input('title');
        $this->article->desc = $request->input('desc') ?: '';
        $this->article->is_top = $request->input('is_top');
        $this->article->content = $request->input('content');
        $this->article->is_single = $request->input('is_single');

        if($this->article->is_single != 0){
            $this->article->images = $request->images;
        }

        $now = date('Y-m-d H:i:s');

        DB::beginTransaction();
        try {

            if (!empty($id)) {
                $this->article->save();
            } else {
                $data = $this->article->toArray();
                $data['created_at'] = $now;
                $data['updated_at'] = $now;
                $id = $this->article->insertGetId($data);
            }

            //标签
            $articleLabelData = $request->input('label');
            if (!empty($articleLabelData)) {
                $LabelData = [];
                foreach ($articleLabelData as $val) {
                    $LabelData[] = [
                        'article_id' => $id,
                        'label_id' => $val,
                        'created_at' => $now,
                        'updated_at' => $now
                    ];
                }
                $this->articleLabel->where('article_id',$id)->delete();
                $this->articleLabel->insert($LabelData);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::response_fail('保存失败');
        }

        return Response::response_success();
    }

    /**
     * 文章详情
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function info(Request $request)
    {
        $id = $request->input('id');

        $data = $this->article
            ->with(['label'=>function ($sql) {
                $sql->where('status',$this->label->status_field[1])->where(DB::raw('article_label.deleted_at'));
            }])
            ->find($id);
        if (!empty($data)) {
            $data = $data->toArray();
            $data['label'] = array_column($data['label'],'id');
        }

        return Response::response_success($data);
    }

    /**
     * 删除文章
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function del(Request $request)
    {
        $id = $request->post('id');

        if (!empty($id)) {
            $this->article->where('id',$id)->delete();
        }

        return Response::response_success();
    }
}