<?php

namespace App\Http\Requests\v1\Auth;

use App\Http\Requests\BaseFormRequest;

class LoginRequest extends BaseFormRequest
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
            'email' => 'required|email',
            'password' => 'required|between:3,20',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('validation.required', ['attribute' => 'e-posta']),
            'password.required' => __('validation.required', ['attribute' => 'password']),
            'password.between' => __('validation.between.numeric', ['min' => 3, 'max' => 20]),
        ];
    }
}
