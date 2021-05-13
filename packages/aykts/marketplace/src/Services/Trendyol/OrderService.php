<?php
/**
 * Created by PhpStorm.
 * User: AykutPC
 * Date: 10.5.2021
 * Time: 21:25
 */

namespace Aykts\Marketplace\Services\Trendyol;

use Illuminate\Support\Facades\Http;

class OrderService extends BaseService
{
    private static $orderListUrl = "https://stageapi.trendyol.com/stagesapigw/suppliers/{supplierid}/orders";

    public function getAllOrders()
    {
        $urlParams = http_build_query([
            "orderByField" => "PackageLastModifiedDate",
            "orderByDirection" => "DESC",
            "size" => 50
        ]);

        $orderListUrl = str_replace('{supplierid}', $this->client->getSupplierId(), self::$orderListUrl);
        $orderListUrl .= "?" . $urlParams;

        $response = Http::withHeaders($this->headers)->get($orderListUrl);

        return $response;
    }
}
