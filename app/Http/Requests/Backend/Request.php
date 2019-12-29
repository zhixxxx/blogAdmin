<?php

namespace App\Http\Requests\Backend;

use App\Common\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class Request extends FormRequest
{
    public function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException(
            Response::response_fail($validator->errors()->first())
        ));
    }
}
