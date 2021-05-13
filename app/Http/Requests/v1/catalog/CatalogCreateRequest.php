<?php

namespace App\Http\Requests\v1\catalog;

use App\Http\Requests\BaseFormRequest;

class CatalogCreateRequest extends BaseFormRequest
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
            'catalog_name' => 'required|string|between:2,250',
            'lang' => 'required|string',
            'top_id' => 'integer',
            'order' => 'required|integer',
            'status' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'catalog_name.required' => __('validation.required', ['attribute' => 'catalog-name']),
            'catalog_name.string' => __('validation.string', ['attribute' => 'catalog-name']),
            'catalog_name.between' => __('validation.between.numeric', ['min' => 2, 'max' => 250]),
            'lang.required' => __('validation.required', ['attribute' => 'lang']),
            'lang.string' => __('validation.string', ['attribute' => 'lang']),
            'top_id.integer' => __('validation.integer', ['attribute' => 'top_id']),
            'order.required' => __('validation.required', ['attribute' => 'order']),
            'order.integer' => __('validation.integer', ['attribute' => 'order']),
            'status.boolean' => __('validation.boolean', ['attribute' => 'status']),
        ];
    }
}
