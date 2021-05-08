<?php
/**
 * Created by PhpStorm.
 * User: AykutPC
 * Date: 14.4.2021
 * Time: 00:29
 */

namespace App\Contracts;

interface BaseInterface
{
    public function getAll();

    public function getById($id);
}

