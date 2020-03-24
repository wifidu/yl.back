<?php

namespace App\Http\Controllers\Api;

use App\Enum\CodeEnum;
use Illuminate\Support\Str;
use App\Http\Requests\Api\ImageRequest;
use App\Http\Resources\ImageResource;
use App\Handlers\ImageUploadHandler;
use App\Http\Controllers\Controller;
use App\Model\Image;
use App\Traits\ApiTraits;

class ImagesController extends Controller
{
    use ApiTraits;
    public function store(ImageRequest $request, ImageUploadHandler $uploader, Image $image)
    {
        $user = $request->user();
        $size = $request->type == 'avatar' ? 416 : 1024;
        $result = $uploader->save($request->image, Str::plural($request->type), $user->id, $size);

        $image->path = $result['path'];
        $image->type = CodeEnum::IMAGE_TYPE[$request->type];
        $image->user_id = $user->id;
        $image->save();

        return $this->apiReturn(new ImageResource($image),CodeEnum::INC_SUCCESS);
    }
}
