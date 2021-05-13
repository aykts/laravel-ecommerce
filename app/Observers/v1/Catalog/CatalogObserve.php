<?php

namespace App\Observers\v1\Catalog;

use App\Models\v1\Catalog\Catalog;
use App\Models\v1\Catalog\CatalogDetail;

class CatalogObserve
{
    /**
     * Handle the Catalog "created" event.
     *
     * @param Catalog $catalog
     * @return void
     */
    public function created(Catalog $catalog)
    {
        CatalogDetail::create([
            'lang' => $catalog->lang,
            'catalog_id' => $catalog->id,
            'catalog_name' => $catalog->catalog_name,
            'title' => $catalog->catalog_name,
            'slug' => $catalog->catalog_name,
            'catalog_description' => ''
        ]);
    }

    /**
     * Handle the Catalog "updated" event.
     *
     * @param Catalog $catalog
     * @return void
     */
    public function updated(Catalog $catalog)
    {
        //
    }

    /**
     * Handle the Catalog "deleted" event.
     *
     * @param Catalog $catalog
     * @return void
     */
    public function deleted(Catalog $catalog)
    {
        //
    }

    /**
     * Handle the Catalog "restored" event.
     *
     * @param Catalog $catalog
     * @return void
     */
    public function restored(Catalog $catalog)
    {
        //
    }

    /**
     * Handle the Catalog "force deleted" event.
     *
     * @param Catalog $catalog
     * @return void
     */
    public function forceDeleted(Catalog $catalog)
    {
        //
    }
}
