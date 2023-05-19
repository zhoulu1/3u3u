<?php

namespace App\Http\Requests\Api;

class RecyclersRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'     => 'required',
            'mobile'   => 'required',
            'province' => 'required',
            'city'     => 'required',
            'county'   => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name'     => '姓名',
            'mobile'   => '手机号',
            'province' => '区域',
            'city'     => '区域',
            'county'   => '区域',
        ];
    }
}
