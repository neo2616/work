<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
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
            'role_name'=>'required|unique:role',
        ];
    }


    public function messages()
    {
        return [
            'role_name.required'=>'用户组名称必须存在!',
            'role_name.unique'=>'用户组名称有存在的!',
        ];
    }
}
