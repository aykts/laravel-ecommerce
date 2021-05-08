<?php
/**
 * Created by PhpStorm.
 * User: AykutPC
 * Date: 14.4.2021
 * Time: 00:17
 */

namespace App\Contracts;

interface CatalogInterface
{
    public function getAll();

    public function getWhere(array $arr);
}
