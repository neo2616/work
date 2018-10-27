<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequest
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
            'ps_name'=>'required',  //权限的名称唯一
            'ps_c'=>'required',
            'ps_a'=>'required',
            'ps_route'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'ps_name.required'=>'权限名称不得为空!',
            'ps_c.required'=>'控制器不得为空!',
            'ps_a.required'=>'方法不得为空!',
            'ps_route.required'=>'路由不得为空!',
        ];
    }
}
