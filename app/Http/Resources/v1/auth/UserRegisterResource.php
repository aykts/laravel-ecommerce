<?php

namespace App\Http\Resources\v1\auth;

use App\Http\Resources\v1\BaseResource;

/**
 * @property mixed name
 * @property mixed email
 * @property mixed token
 * @property mixed id
 */
class UserRegisterResource extends BaseResource
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
            'token' => $this->token,
        ];
    }
}
