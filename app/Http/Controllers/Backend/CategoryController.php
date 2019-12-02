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
        $query = $this->category->select('id','name','pid','created_at','updated_at');

        if(!strcmp($source,'article')){
            $data = $query->where('pid','!=',0)->get();
        }else{
            $data = $query->paginate($pageSize);
        }
        return $this->response_success($data);
    }
}
