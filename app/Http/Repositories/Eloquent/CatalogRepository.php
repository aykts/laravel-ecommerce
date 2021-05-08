<?php

namespace App\Http\Repositories\Eloquent;

use App\Contracts\CatalogInterface;
use App\Models\Catalog;

class CatalogRepository extends BaseRepository implements CatalogInterface
{

    /**
     * CatalogRepository constructo.
     * @param Catalog $model
     */
    public function __construct(Catalog $model)
    {
        parent::__construct($model);
    }

    public function getWhere(array $arr)
    {
        return $this->model->where(...$arr)->first();
    }

}
