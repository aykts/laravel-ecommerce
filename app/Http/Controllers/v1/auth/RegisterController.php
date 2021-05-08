<?php

namespace App\Http\Controllers\v1\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Auth\RegisterRequest;
use App\Http\Resources\v1\auth\UserRegisterResource;
use App\Models\User;
use Exception;
use Laravel\Passport\ClientRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index(RegisterRequest $request): JsonResponse
    {

        DB::beginTransaction();

        try {
            $user = new User;

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = $request->input('password');

            $user->save();

            DB::commit();

            $user["token"] = $this->getTokenAndRefreshToken(
                $request->only('email', 'password')
            );

            $return_data = $this->ok(__('register.succeeded'), new UserRegisterResource($user));

            return $return_data;
        } catch (Exception $e) {

            DB::rollback();

            return $this->fail($e->getMessage());
        }
    }

    protected function createPasswordGrantClient($userId, $userName, $redirectUrl)
    {
        return (new ClientRepository)->createPasswordGrantClient($userId, $userName, $redirectUrl);
    }

    protected function createPersonalAccessClient($userId, $userName, $redirectUrl)
    {
        return (new ClientRepository)->createPersonalAccessClient($userId, $userName, $redirectUrl);
    }
}
