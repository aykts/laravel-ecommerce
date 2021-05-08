<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method find($id)
 * @method create(array $store)
 * @method where(array $clause)
 */
class Catalog extends Model
{
    use HasFactory;

    protected $filterFields = ['store_id', 'lang', 'status', 'top_id'];
    protected $fillable = ['store_id', 'catalog_name', 'lang', 'top_id', 'order', 'status'];

    public function filterableFields()
    {
        return $this->filterFields;
    }

}
