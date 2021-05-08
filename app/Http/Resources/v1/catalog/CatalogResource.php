<?php

namespace App\Http\Resources\v1\catalog;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed id
 * @property mixed store_id
 * @property mixed catalog_name
 * @property mixed top_id
 * @property mixed status
 * @property mixed lang
 */
class CatalogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'catalog_name' => $this->catalog_name,
            'top_id' => $this->top_id,
            'status' => $this->status,
            'lang' => empty($this->lang) ? config("app.fallback_locale") : $this->lang,
        ];
    }
}
