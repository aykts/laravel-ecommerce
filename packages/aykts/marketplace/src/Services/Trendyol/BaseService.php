<?php
/**
 * Created by PhpStorm.
 * User: AykutPC
 * Date: 10.5.2021
 * Time: 21:26
 */

namespace Aykts\Marketplace\Services\Trendyol;

use App\Http\Controllers\Controller;
use Aykts\Marketplace\Controllers\Trendyol\TrendyolClient;

class BaseService extends Controller
{
    protected $headers;
    protected $client;

    public function __construct(TrendyolClient $client)
    {
        $this->client = $client;

        $this->headers = [
            'Content-Type' => 'application/json',
            'User-Agent' => "{$this->client->getSupplierId()} - SelfIntegration",
            'Authorization' => "Basic " . base64_encode($this->client->getApiKey() . ":" . $this->client->getApiSecretKey())
        ];
    }
}
