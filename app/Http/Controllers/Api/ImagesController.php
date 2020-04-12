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

    /**
     * showdoc
     * @catalog 接口文档/用户认证&权限管理
     * @title 上传图片
     * @description 上传图片信息的接口
     * @method `post`  `application/form-data`
     * @url {{host}}/api/images
     * @param image 必选 file 图片文件
     * @param type 必选 string 类型 avatar-头像 other-普通图片
     * @header Authorization 必选  string 应用认证token(Bearer类型)
     * @return {"status":201,"message":"新增成功","data":{"path":"http://localhost/uploads/images/avatars/202003/24/26_1585036245_KB6DFSCHmL.jpg","type":0,"user_id":26,"updated_at":"2020-03-24 15:50:46","created_at":"2020-03-24 15:50:46","id":2}}
     * @return_param id int 图片id
     * @return_param path string 图片路径
     * @return_param type string 类型 0-头像 1-普通图片
     * @return_param user_id string 上传图片用户id
     * @remark type为头像会对图片进行切割成 200*200px
     */
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
