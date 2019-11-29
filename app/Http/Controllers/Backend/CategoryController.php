<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;
    private $pageSize = 10;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getList(Request $request)
    {
        $source = $request->input('source','list');
        $pageSize = $request->input('pageSize',$this->pageSize);
        $data = [];
        $query = $this->category->select('id','name','pid','created_at','updated_at');

        if(!strcmp($source,'article')){
            $result = $query->get();
            foreach ($result as $key=>$val){
                if($val->pid == 0){
                    $data[$val->id][] = [
                        'value' => $val->id,
                        'label' => $val->name,
                    ];
                }
                if($val->pid != 0){
                    $data[$val->pid]['children'][] = [
                        'value' => $val->id,
                        'label' => $val->name,
                    ];
                }
            }
            $data = array_values($data);
        }else{
            $data = $query->paginate($pageSize);
        }
        return $this->response_success($data);
    }
}
