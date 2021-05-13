<?php
/**
 * Created by PhpStorm.
 * User: AykutPC
 * Date: 11.5.2021
 * Time: 10:13
 */

namespace Aykts\Marketplace\Services\Trendyol;


use Illuminate\Support\Facades\Http;

class CategoryService extends BaseService
{
    private static $getCategoriesUrl = 'https://stageapi.trendyol.com/stagesapigw/product-categories';

    public function getCategories()
    {
        $apiUrl = self::$getCategoriesUrl;

        $response = Http::withHeaders($this->headers)
            ->get($apiUrl);

        return $response;
    }

}
