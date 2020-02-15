<?php

namespace App\Http\Controllers\Api;

use App\Enum\CodeEnum;
use App\Http\Requests\Api\ImageRequest;
use App\Handlers\ImageUploadHandler;
use App\Http\Controllers\Controller;
use App\Model\Image;
use App\Traits\ApiTraits;

class ImagesController extends Controller
{
    use ApiTraits;
    public function store(ImageRequest $request, ImageUploadHandler $uploader, Image $image)
    {
        $user = \Auth::guard('api')->user();

        $size = $request->type == "0" ? 362 : 1024;
        $result = $uploader->save($request->image, str_plural($request->type), $user->id, $size);

        $image->path = $result['path'];
        $image->type = (int)$request->type;
        $image->user_id = $user->id;
        $image->save();

        return $this->apiReturn($image,CodeEnum::INC_SUCCESS);
    }
}
