<?php

namespace App\Http\Controllers\v1\product;

use App\Http\Controllers\Controller;
use Aykts\Marketplace\Facades\Trendyol;

class ProductController extends Controller
{
    public function index()
    {
        $items = [
            "items" => [
                [
                    "barcode" => "3010001005",
                    "quantity" => 250,
                    "salePrice" => 55.75,
                    "listPrice" => 80.00
                ]
            ]
        ];

        $getProduct = Trendyol::ProductService()->updateStockPrice($items);

        dd($getProduct->getData()->data);
    }
}
