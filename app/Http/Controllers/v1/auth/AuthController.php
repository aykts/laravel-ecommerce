<?php

namespace App\Http\Controllers\v1\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Auth\RefreshTokenRequest;
use App\Http\Resources\v1\auth\AuthResource;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function me()
    {
        if (Auth::check()) {

            $return_data = $this->ok("", new AuthResource(auth('api')->user()));

        } else {

            $return_data = $this->fail(__('auth.unauthorized_access'));

        }
        return $return_data;
    }

    /**
     * @param RefreshTokenRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshToken(RefreshTokenRequest $request): JsonResponse
    {
        try {
            $result = $this->getRefreshToken($request->input('refresh_token'));
            $return_data = $this->ok(__('auth.refresh_token'), $result);

        } catch (GuzzleException $e) {

            $catch_error = json_decode($e->getResponse()->getBody(), true);
            $return_data = $this->fail($catch_error["error"]);

        }

        return $return_data;
    }
}
