<?php

namespace App\Http\Resources\v1\auth;

use App\Http\Resources\v1\BaseResource;

/**
 * @property mixed email
 * @property mixed token
 */
class UserLoginResource extends BaseResource
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
            'email' => $this->email,
            'token' => $this->token,
        ];
    }
}
