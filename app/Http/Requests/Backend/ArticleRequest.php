<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

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
            'content.required' => '文章内容不能为空'
        ];
    }


}
