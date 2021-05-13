<?php
/**
 * Created by PhpStorm.
 * User: AykutPC
 * Date: 10.5.2021
 * Time: 21:27
 */

namespace Aykts\Marketplace\Services\Trendyol;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ProductService extends BaseService
{
    private static $updateInventoryUrl = 'https://stageapi.trendyol.com/stagesapigw/suppliers/{supplierid}/products/price-and-inventory';
    private static $batchRequestUrl = 'https://stageapi.trendyol.com/stagesapigw/suppliers/?/products/batch-requests/?';

    public function updateStockPrice($products)
    {
        $apiUrl = str_replace('{supplierid}', $this->client->getSupplierId(), self::$updateInventoryUrl);

        $response = Http::withHeaders($this->headers)
            ->post($apiUrl, $products);

        return $response;
    }

    public function getBatchRequestResult($batchRequestId)
    {
        if (\is_null($batchRequestId)) {
            return response()->json([
                'status' => false,
                'data' => 'BatchRequestId boş!'
            ]);
        }

        $apiUrl = Str::replaceArray('?', [$this->client->getSupplierId(), $batchRequestId], self::$batchRequestUrl);

        $response = Http::withHeaders($this->headers)
            ->get($apiUrl);

        return $response;
    }
}
