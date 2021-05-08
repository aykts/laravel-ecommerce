<?php

namespace App\Http\Resources\v1\auth;

use App\Http\Resources\v1\BaseResource;

/**
 * @property mixed email
 * @property mixed name
 * @property mixed id
 */
class AuthResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
