<?php

namespace App\Http\Requests\Backend;


class ArticleRequest extends FormRequest
{

    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
                return [
                    'pageSize' => 'bail|required|integer|min:5',
                ];
                break;
            case 'POST':
                return [
                    'title' => 'required',
                    'category_id' => 'required|integer|min:1',
                    'content' => 'required'
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'pageSize.required' => '页数不能为空',
            'pageSize.integer' => '页数必须为整数',
            'pageSize.min' => '页数不得少于:min',
            'title.required' => '标题不能为空',
            'category_id.required' => '分类id不能为空',
            'category_id.integer' => '分类id必须为整数',
            'category_id.min' => '分类id不得小于1',
            'content.required' => '文章内容不能为空'
        ];
    }


}
