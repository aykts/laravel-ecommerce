<?php
/**
 * Created by PhpStorm.
 * User: AykutPC
 * Date: 21.8.2020
 * Time: 02:08
 */

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

trait TraitApiResponser
{
    /**
     * @param array $data
     * @param null $message
     * @param int $code
     * @return JsonResponse
     */
    protected function ok($message = null, $data = [], $code = JsonResponse::HTTP_OK): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * @param array $error
     * @param array $data
     * @param int $code
     * @return JsonResponse
     */
    protected function fail($error = [], $data = [], $code = JsonResponse::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json([
            'status' => false,
            'error' => $error,
            'data' => $data,
        ], $code);
    }

    /**
     * @param $credentials
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function getTokenAndRefreshToken($credentials)
    {
        $client = DB::table('oauth_clients')->where('password_client', 1)->first();
        $return_obj = "";

        try {

            $response = (new Client)->request(
                'POST',
                'http://192.168.1.109:8084/oauth/token',
                [
                    'form_params' => [
                        'grant_type' => 'password',
                        'client_id' => $client->id,
                        'client_secret' => $client->secret,
                        'username' => $credentials["email"],
                        'password' => $credentials["password"],
                        'scope' => '*',
                    ],
                ]);

            $return_obj = json_decode((string)$response->getBody(), true);

        } catch (RequestException  $e) {

            if ($e->hasResponse()) {
                throw $e;
            }

        }

        return $return_obj;
    }

    /**
     * @param string $refresh_token
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return mixed
     * ´     */
    protected function getRefreshToken($refresh_token = "")
    {
        $client = DB::table('oauth_clients')->where('password_client', 1)->first();

        $response = (new Client)->request(
            'POST',
            'http://192.168.1.109:8084/oauth/token',
            [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $refresh_token,
                    'client_id' => $client->id,
                    'client_secret' => $client->secret,
                    'scope' => '*',
                ],
            ]);

        return json_decode((string)$response->getBody(), true);
    }
}
