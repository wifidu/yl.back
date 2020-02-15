<?php

namespace App\Http\Controllers\Api;

use App\Enum\CodeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\Model\Image;
use App\Model\User;
use App\Traits\ApiTraits;

class UsersController extends Controller
{
    use ApiTraits;
    public function store(UserRequest $request)
    {

        $user = User::create([
            'name' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return $this->apiReturn($user,CodeEnum::INC_SUCCESS);
    }

    public function me()
    {
        $user = \Auth::guard('api')->user();
        $user->mate = [
            'access_token' => \Auth::guard('api')->fromUser(\Auth::guard('api')->user()),
            'token_type' => 'Bearer',
            'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
        ];

        return $this->apiReturn($user,CodeEnum::SUCCESS);
    }

    public function update(UserRequest $request)
    {
        $user = \Auth::guard('api')->user();

        $attributes = $request->only(['name']);

        if ($request->avatar_image_id) {
            $image = Image::find($request->avatar_image_id);

            $attributes['avatar'] = $image->path;
        }
        $user->update($attributes);

        return $this->apiReturn($user,CodeEnum::SUCCESS);
    }
}
