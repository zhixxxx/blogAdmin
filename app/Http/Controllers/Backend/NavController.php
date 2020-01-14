<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/1/14
 * Time: 16:10
 */

namespace App\Http\Controllers\Backend;


use App\Common\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\NavRequest;
use App\Models\Navigation;
use Illuminate\Http\Request;

class NavController extends Controller
{
    private $nav;
    private $pageSize = 10;
    private $request;

    public function __construct(Navigation $navigation, Request $request)
    {
        $this->nav = $navigation;
        $this->request = $request;
    }

    public function getList()
    {
        $pageSize = $this->request->input('pageSize',$this->pageSize);

        $data = $this->nav->paginate($pageSize);

        return Response::response_success($data);
    }

    public function save(NavRequest $request)
    {
        $id = $request->input('id',0);
        $name = $request->input('name');
        $weight = $request->input('weight');

        if ($id) {
            $data= $this->nav->find($id);
        } else {
            $data = $this->nav;
        }

        $data->name = $name;
        $data->weight = $weight;
        $data->save();

        return Response::response_success();
    }

    public function del()
    {
        $id = $this->request->input('id');

        $result = $this->nav->where('id',$id)->delete();

        if ($result) {
            return Response::response_success();
        }
        return Response::response_fail('删除失败');
    }
}