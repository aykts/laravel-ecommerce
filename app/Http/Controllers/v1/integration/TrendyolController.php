<?php

namespace App\Http\Controllers\v1\integration;

use App\Http\Controllers\Controller;
use Aykts\Marketplace\Facades\Trendyol;
use Illuminate\Http\Request;

class TrendyolController extends Controller
{

    public function getCategories(Request $request)
    {
        $categoryId = $request->input('categoryId') ?? '';

        $getCategories = Trendyol::CategoryService()->getCategories();

        $responseBody = json_decode($getCategories->body());
        $responseBody = $responseBody->categories;

        if ($getCategories->failed())
            return $this->fail('Kategori Listesi', $responseBody);

        $responseBody = collect($responseBody);

        if (!empty($categoryId)) {
            $responseBody = $responseBody->filter(function ($collection) use ($categoryId) {
                return $collection->id == $categoryId;
            });
        }

        return $this->ok('Kategori Listesi', $responseBody);
    }

    public function getBrandWithName(Request $request)
    {
        $params = [
            'name' => $request->input('name') ?? ''
        ];

        $getBrands = Trendyol::BrandService()->getBrandWithName($params);

        $responseBody = json_decode($getBrands->body());

        if ($getBrands->failed())
            return $this->fail('Marka Listesi', $responseBody);

        return $this->ok('Marka Listesi', $responseBody);
    }

    public function getBrands(Request $request)
    {
        $params = [
            'page' => $request->input('page') ?? 1,
            'size' => $request->input('size')
        ];

        $getBrands = Trendyol::BrandService()->getBrands($params);

        $responseBody = json_decode($getBrands->body());

        if ($getBrands->failed())
            return $this->fail('Marka Listesi', $responseBody);

        return $this->ok('Marka Listesi', $responseBody);
    }

    public function getBatchRequestResult(?string $batchRequestId)
    {
        $getBatchRequestResult = Trendyol::ProductService();
        $getBatchRequestResult = $getBatchRequestResult->getBatchRequestResult($batchRequestId);

        $responseBody = json_decode($getBatchRequestResult->body());

        if ($getBatchRequestResult->failed())
            return $this->fail('Ürün Güncelleme Durum', $responseBody);

        return $this->ok('Ürün Güncelleme Durum', $responseBody);
    }

    public function updateStockPrice()
    {
        $items = [
            "items" => [
                [
                    "barcode" => "867046",
                    "quantity" => 100,
                    "salePrice" => 112.85,
                    "listPrice" => 113.85
                ],
                [
                    "barcode" => "DRL-0000001",
                    "quantity" => 500,
                    "salePrice" => 112.85,
                    "listPrice" => 113.85
                ]
            ]
        ];

        $updateStockPrice = Trendyol::ProductService();
        $updateStockPrice = $updateStockPrice->updateStockPrice($items);

        $responseBody = json_decode($updateStockPrice->body());

        if ($updateStockPrice->failed())
            return $this->fail('Ürün Güncelleme', $responseBody);

        return $this->ok('Ürün Güncelleme', $responseBody);
    }

    public function orders()
    {
        $getAllOrders = Trendyol::OrderService();
        $getAllOrders = $getAllOrders->getAllOrders();

        $responseBody = json_decode($getAllOrders->body());

        if ($getAllOrders->failed())
            return $this->fail('Sipariş Listesi', $responseBody);

        return $this->ok('Sipariş Listesi', $responseBody);
    }
}
