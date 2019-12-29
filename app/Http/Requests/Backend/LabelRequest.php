<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class LabelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status' => ['required','integer','min:1','max:2']
        ];
    }

    public function messages()
    {
        return [
            'status.required' => '状态不能为空',
            'status.integer' => '状态只能是整数',
            'status.min' => '状态只能是1和2',
            'status.max' => '状态只能是1和2'
        ];
    }
}
