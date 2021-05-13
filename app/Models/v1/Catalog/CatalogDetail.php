<?php

namespace App\Models\v1\Catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CatalogDetail extends Model
{
    use HasFactory;

    protected $fillable = ['lang', 'catalog_id', 'catalog_name', 'title', 'slug', 'catalog_description'];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }
}
