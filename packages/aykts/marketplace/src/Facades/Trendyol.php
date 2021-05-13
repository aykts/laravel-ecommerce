<?php
/**
 * Created by PhpStorm.
 * User: AykutPC
 * Date: 9.5.2021
 * Time: 19:58
 */

namespace Aykts\Marketplace\Facades;


use Illuminate\Support\Facades\Facade;

class Trendyol extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Trendyol';
    }
}
