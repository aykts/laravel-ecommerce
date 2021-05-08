<?php

namespace App\Http\Controllers\v1\catalog;

use App\Enums\v1\catalog\CatalogEnums;
use App\Enums\v1\GlobalEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\catalog\CatalogCreateRequest;
use App\Http\Resources\v1\catalog\CatalogResource;
use App\Models\Catalog;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $catalog_lists = Catalog::paginate(GlobalEnum::PerPage);

        if (!is_null($catalog_lists)) {
            return $this->ok('', CatalogResource::collection($catalog_lists)->response()->getData(true));
        }

        return $this->ok(__('global.record_not_found'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CatalogCreateRequest $request
     * @return JsonResponse
     */
    public function store(CatalogCreateRequest $request): JsonResponse
    {

        $request_form = $request->input();

        try {

            $catalog_data = [
                'store_id' => $request->input('store_id'),
                'catalog_name' => $request->input('catalog_name'),
                'top_id' => $request->input('top_id'),
                'order' => $request->input('order'),
                'status' => $request->input('status') ?? CatalogEnums::Active,
                'lang' => $request->input('lang') ?? CatalogEnums::DefaultLanguage
            ];

            $add_catalog = Catalog::create($catalog_data);

            if (!empty($add_catalog)) {
                $return_data = $this->ok(__('global.process_success'), $request_form);
            } else {
                $return_data = $this->fail(__('global.process_failed'), $request_form);
            }

        } catch (QueryException $exception) {

            $return_data = $this->fail($exception->errorInfo, $request_form);

        } catch (Exception $exception) {

            $return_data = $this->fail($exception->getMessage(), $request_form);

        }

        return $return_data;

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $catalog_detail = Catalog::where("id", "=", $id,)->first();

        if (!is_null($catalog_detail)) {
            return $this->ok("", new CatalogResource($catalog_detail));
        }

        return $this->ok(__('global.record_not_found'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
