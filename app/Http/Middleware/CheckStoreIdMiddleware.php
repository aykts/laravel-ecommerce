<?php

namespace App\Http\Middleware;

use App\Models\v1\Store\Store;
use App\Scopes\StoreScope;
use App\Traits\TraitApiResponser;
use Closure;
use Illuminate\Http\Request;

class CheckStoreIdMiddleware
{
    use TraitApiResponser;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $store_id = $request->header('store-id');

        if (is_null($store_id) or !is_numeric($store_id)) {

            $get_default_store_id = Store::withoutGlobalScope(StoreScope::class)->where('default_store', 1)
                ->firstOr(function () {
                    return false;
                });

            if (!$get_default_store_id) {
                return $this->fail(
                    __('validation.required', ['attribute' => 'Store ID']),
                    $request->all()
                );
            }

            $store_id = $get_default_store_id->id;
        }

        $request->attributes->add(['store_id' => $store_id]);

        return $next($request);
    }
}
