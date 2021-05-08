<?php

namespace App\Http\Controllers;

use App\Traits\TraitApiResponser;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use TraitApiResponser, AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
