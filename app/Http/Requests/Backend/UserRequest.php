<?php

namespace App\Http\Requests\Backend;

class UserRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()){
            case 'GET':
                return [
                    'username' => 'required|min:5|max:12',
                    'password' => 'required|min:6|max:16'
                ];
            case 'POST':
                return [
                    'username' => 'required|min:5|max:12|unique:admin_user,username',
                    'password' => 'required|min:6|max:16'
                ];
            case 'PUT':
            case 'PATCH':
            case 'DELETE':
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'id.required'=>'用户ID不能为空',
            'id.exists'=>'用户不存在',
            'username.unique' => '用户名已经存在',
            'username.required' => '用户名不能为空',
            'username.max' => '用户名最大长度为12个字符',
            'password.required' => '密码不能为空',
            'password.max' => '密码长度不能超过16个字符',
            'password.min' => '密码长度不能小于6个字符'
        ];
    }
}
