<?php

namespace App\Http\Controllers\Api;

use App\Enum\CodeEnum;
use \App\Traits\ApiTraits;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthorizationRequest;

class AuthorizationsController extends Controller
{
    use ApiTraits;
    public function login(AuthorizationRequest $request)
    {
        $credentials['name'] = $request->username;
        $credentials['password'] = $request->password;

        if (!$token = \Auth::guard('api')->attempt($credentials)) {
            return $this->apiReturn('',CodeEnum::ERR_NAME_OR_PASSWORD);
        }

        return $this->apiReturn([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
        ],CodeEnum::SUCCESS);
    }
}
