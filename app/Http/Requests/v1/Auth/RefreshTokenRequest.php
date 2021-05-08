<?php

namespace App\Http\Requests\v1\Auth;

use App\Http\Requests\BaseFormRequest;

class RefreshTokenRequest extends BaseFormRequest
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
            'refresh_token' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'refresh_token.required' => __('validation.required', ['attribute' => 'refresh token']),
        ];
    }
}
