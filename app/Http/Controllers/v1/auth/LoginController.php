<?php

namespace App\Http\Controllers\v1\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Auth\LoginRequest;
use App\Http\Resources\v1\auth\UserLoginResource;
use Exception;
use stdClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index(LoginRequest $request): JsonResponse
    {
        try {

            $credentials = $request->only('email', 'password');

            if (Auth::guard()->attempt($credentials)) {

                $token = $this->getTokenAndRefreshToken(
                    $credentials
                );

                $user = new stdClass();
                $user->email = $credentials["email"];
                $user->token = $token;

                $return_data = $this->ok(__('login.succeeded'), new UserLoginResource($user));

            } else {

                $return_data = $this->fail(__('auth.failed'), $request->all(), JsonResponse::HTTP_UNAUTHORIZED);

            }

        } catch (Exception $e) {

            $error_obj = json_decode($e->getResponse()->getBody()->getContents(), true);

            $return_data = $this->fail($error_obj["error"], [], JsonResponse::HTTP_UNAUTHORIZED);
        }

        return $return_data;
    }

}
