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

    public function getList()
    {
        $pageSize = $this->request->input('pageSize',$this->pageSize);
        $name = $this->request->input('name','');


        $data = $this->label
            ->where(function ($sql) use ($name) {
                if ($name) {
                    $sql->where('name','like','%'.$name.'%');
                }
            })
            ->paginate($pageSize);

        return Response::response_success($data);
    }

    public function save(LabelRequest $request)
    {
        $name = $request->input('name');
        $status = $request->input('status');


        $data= $this->label->where('name',$name)->first();
        if (!$data) {
            $data = new $this->label;
        }

        $data->name = $name;
        $data->status = $status;
        $data->save();

        return Response::response_success();
    }

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