<?php

namespace App\Models\v1\Catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method find($id)
 * @method create(array $store)
 * @method where(array $clause)
 * @property mixed catalog_name
 * @property mixed id
 * @property mixed lang
 */
class Catalog extends Model
{
    use HasFactory;

    protected $filterFields = ['store_id', 'lang', 'status', 'top_id'];
    protected $fillable = ['lang', 'store_id', 'catalog_name', 'top_id', 'order', 'status'];

    public function filterableFields()
    {
        return $this->filterFields;
    }
}
