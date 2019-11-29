<?php

namespace App\Http\Requests\Backend;


class ArticleRequest extends FormRequest
{

    public function rules()
    {
        return [
            'pageSize' => [
                'required',
                'integer',
                'min:5',
            ],
        ];
    }

    public function messages()
    {
        return [
            'pageSze.required' => '页数不能为空',
        ];
    }
}
