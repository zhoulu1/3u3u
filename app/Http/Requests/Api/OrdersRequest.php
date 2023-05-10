<?php

namespace App\Http\Requests\Api;

class OrdersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'address' => 'required',
            'category_id' => 'required',
            'weight_desc' => 'required',
            'appointment_time' => 'required',
            'remark' => 'max:190',
        ];
    }

    public function attributes()
    {
        return [
            'address'      => '地址',
            'category_id'  => '分类',
            'weight_desc'  => '预估重量',
            'appointment_time'  => '上门时间',
            'remark'  => '其他要求',
        ];
    }
}
