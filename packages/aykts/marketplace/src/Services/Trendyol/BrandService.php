<?php
/**
 * Created by PhpStorm.
 * User: AykutPC
 * Date: 11.5.2021
 * Time: 00:18
 */

namespace Aykts\Marketplace\Services\Trendyol;


use Illuminate\Support\Facades\Http;

class BrandService extends BaseService
{
    private static $getBrandsUrl = 'https://stageapi.trendyol.com/stagesapigw/brands';
    private static $getBrandWithNameUrl = 'https://stageapi.trendyol.com/stagesapigw/brands/by-name';

    public function getBrands(array $params)
    {
        $params = http_build_query($params);

        $apiUrl = self::$getBrandsUrl . '?' . $params;

        $response = Http::withHeaders($this->headers)
            ->get($apiUrl);

        return $response;
    }

    public function getBrandWithName(array $params)
    {
        $params = http_build_query($params);

        $apiUrl = self::$getBrandWithNameUrl . '?' . $params;

        $response = Http::withHeaders($this->headers)
            ->get($apiUrl);

        return $response;
    }
}
