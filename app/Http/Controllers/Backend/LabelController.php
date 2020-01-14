<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/26
 * Time: 15:07
 */

namespace App\Http\Controllers\Backend;


use App\Common\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\LabelRequest;
use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{

    private $label;
    private $pageSize = 10;
    private $request;

    public function __construct(Label $label, Request $request)
    {
        $this->label = $label;
        $this->request = $request;
    }

    /**
     * 标签列表
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $pageSize = $this->request->input('pageSize',$this->pageSize);
        $name = $this->request->input('name','');
        $source = $this->request->input('source','list');

        $query = $this->label
            ->where(function ($sql) use ($name) {
                if ($name) {
                    $sql->where('name','like','%'.$name.'%');
                }
            });

        if(!strcmp($source,'article')){
            $data = $query->where('status',1)->get();
        }else{
            $data = $query->paginate($pageSize);
        }

        return Response::response_success($data);
    }

    /**
     * 修改、添加标签
     * @param LabelRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(LabelRequest $request)
    {
        $name = $request->input('name');
        $status = $request->input('status');

        $id = $request->input('id',0);

        if ($id) {
            $data= $this->label->find($id);
        } else {
            $data = $this->label;
        }

        $data->name = $name;
        $data->status = $status;
        $data->save();

        return Response::response_success();
    }

    /**
     * 删除标签
     * @return \Illuminate\Http\JsonResponse
     */
    public function del()
    {
        $id = $this->request->input('id');

        $result = $this->label->where('id',$id)->delete();

        if ($result) {
            return Response::response_success();
        }
        return Response::response_fail('删除失败');
    }
}