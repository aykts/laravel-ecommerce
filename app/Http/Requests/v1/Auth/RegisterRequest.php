<?php

namespace App\Http\Requests\v1\Auth;

use App\Http\Requests\BaseFormRequest;

class RegisterRequest extends BaseFormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|between:2,20',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|between:3,20',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required', ['attribute' => 'Ad']),
            'name.between' => __('validation.between.numeric', ['min' => 2, 'max' => 20]),
            'email.required' => __('validation.required', ['attribute' => 'e-posta']),
            'email.unique' => __('validation.unique', ['attribute' => 'e-posta']),
            'password.between' => __('validation.between.numeric', ['min' => 3, 'max' => 20]),
            'password.confirmed' => __('validation.confirmed', ['attribute' => 'Parola']),
        ];
    }
}
