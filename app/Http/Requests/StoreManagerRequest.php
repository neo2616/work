<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreManagerRequest extends FormRequest
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
            'mg_name'=>'required',
            'password'=>'required',
            'role_id'=>'required',
            'status'=>'required',
        ];
    }


    public function messages()
    {
        return [
            'mg_name.required'=>'用户名必须添写!',
            //'mg_name.unique'=>'用户名存在的呢!',
            'password.required'=>'密码必须填写!',
            'role_id.required'=>'所属用户组必须填写!',
            'status.required'=>'状态必须填写!',
        ];
    }
}
