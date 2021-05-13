<?php

namespace Aykts\Marketplace\Controllers\Trendyol;

use App\Http\Controllers\Controller;

class TrendyolClient extends Controller
{
    private $supplierId;
    private $apiSecretKey;
    private $apiKey;

    public function getApiSecretKey()
    {
        return $this->apiSecretKey;
    }

    public function setApiSecretKey($apiSecretKey)
    {
        $this->apiSecretKey = $apiSecretKey;
    }

    public function getSupplierId()
    {
        return $this->supplierId;
    }

    public function setSupplierId($supplierId)
    {
        $this->supplierId = $supplierId;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }
}
