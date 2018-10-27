<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoginRequest extends FormRequest
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
            'mg_name'=>'required|min:1',
            'password'=>'required|min:4',
            'code'=>'required|captcha'
        ];
    }

    public function messages()
    {
        return [
            'mg_name.required' => '用户名必须存在!',
            'mg_name.min' => '用户名不得小于1个字符!',
            'password.required' => '密码必须存在!',
            'password.min' => '密码不得小于4个字符!',
            'code.required' => '验证码必须存在!',
            'code.captcha' => '验证码错误!',
        ];
    }

}
