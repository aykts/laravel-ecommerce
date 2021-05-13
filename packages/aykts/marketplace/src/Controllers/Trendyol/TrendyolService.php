<?php

namespace Aykts\Marketplace\Controllers\Trendyol;

use Aykts\Marketplace\Services\Trendyol\BaseService;

class TrendyolService extends BaseService
{
    public function __construct(TrendyolClient $client)
    {
        parent::__construct($client);
    }

    public function __call($method, $parameters)
    {
        $serviceName = "Aykts\Marketplace\Services\Trendyol\\" . $method;

        return new $serviceName($this->client);
    }
}
