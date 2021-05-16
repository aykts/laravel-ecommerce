<?php
/**
 * Created by PhpStorm.
 * User: AykutPC
 * Date: 16.5.2021
 * Time: 21:40
 */

declare(strict_types=1);

namespace App\Dto\v1;


use App\Enums\v1\catalog\CatalogEnums;
use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Http\Request;

final class CatalogStoreDto extends DataTransferObject
{

    /*
     *@var string $catalog_name
     */
    public $catalog_name;

    /*
     *@var integer $top_id
     */
    public $top_id;

    /*
     *@var integer $order
     */
    public $order;

    /*
     *@var bool $status
     */
    public $status;

    /*
     *@var string $lang
     */
    public $lang;

    public static function fromRequest(Request $request): self
    {
        return new self([
            'catalog_name' => $request->input('catalog_name'),
            'top_id' => $request->input('top_id'),
            'order' => $request->input('order'),
            'status' => $request->input('status') ?? CatalogEnums::Active,
            'lang' => $request->input('lang') ?? CatalogEnums::DefaultLanguage,
        ]);
    }
}
