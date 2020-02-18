<?php

namespace App\Http\Controllers\Api;

use App\Enum\CodeEnum;
use App\Http\Controllers\Controller;
use App\Traits\ApiTraits;

class ModelPermissionController extends Controller
{
    use ApiTraits;

    public function modelHavePermisson()
    {
        return \Auth::guard('api')->user()->getAllPermissions();
    }

}
