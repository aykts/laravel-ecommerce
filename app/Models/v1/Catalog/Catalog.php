<?php

namespace App\Models\v1\Catalog;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property mixed catalog_name
 * @property mixed id
 * @property mixed lang
 * @method static paginate(string $PerPage)
 * @method create(array $validated)
 */
class Catalog extends BaseModel
{
    use HasFactory;

    protected $filterFields = ['store_id', 'lang', 'status', 'top_id'];
    protected $fillable = ['lang', 'store_id', 'catalog_name', 'top_id', 'order', 'status'];

    public function filterableFields()
    {
        return $this->filterFields;
    }
}
