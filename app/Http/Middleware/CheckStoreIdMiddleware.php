<?php

namespace App\Http\Middleware;

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
        $store_id = $request->header('StoreId');

        if (is_null($store_id) or !is_numeric($store_id)) {
            return $this->fail(
                __('validation.required', ['attribute' => 'Store ID']),
                $request->all()
            );
        }

        $request->attributes->add(['StoreId' => $store_id]);

        return $next($request);
    }
}
