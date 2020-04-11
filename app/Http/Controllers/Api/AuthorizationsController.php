<?php

namespace App\Http\Controllers\Api;

use App\Enum\CodeEnum;
use \App\Traits\ApiTraits;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthorizationRequest;

class AuthorizationsController extends Controller
{
    use ApiTraits;

    /**
     * showdoc
     * @catalog 接口文档/用户认证&权限管理
     * @title 获取token
     * @description 获取用户可以使用的token的接口
     * @method get  application/json
     * @url {{host}}/api/authorizations
     * @param username 必选 string 用户名
     * @param password 必选 string 密码
     * @json_param {"username":"admin","password":"admin"}
     * @return {"status":200,"message":"操作成功","data":{"access_token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC81OS4xMTAuMjEyLjExNjozMjgwMVwvYXBpXC9hdXRob3JpemF0aW9ucyIsImlhdCI6MTU4NjYwMTEyNiwiZXhwIjoxNTg2NjA0NzI2LCJuYmYiOjE1ODY2MDExMjYsImp0aSI6IlR6c25rQzVFVHc3UUJZUzYiLCJzdWIiOjM1LCJwcnYiOiJmNmI3MTU0OWRiOGMyYzQyYjc1ODI3YWE0NGYwMmI3ZWU1MjlkMjRkIn0.yEtMzMwShQR1pReHQ5gwUR2eWfaa-2AAt68bTmCgoKs","token_type":"Bearer","expires_in":3600}}
     * @return_param access_token string token
     * @return_param token_type string token类型
     * @return_param expires_in int token有效期(单位：秒)
     * @remark 新的Token，从当前时间开始计算的Token，并不代表当前Token不能使用，建议将现有Token替换成新的Token以延长使用时间
     */
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

    /**
     * showdoc
     * @catalog 接口文档/用户认证&权限管理
     * @title 退出登录
     * @description 用户退出登录的接口，登出后token失效
     * @method post
     * @url {{host}}/api/authorizations
     * @header Authorization 必选  string 应用认证token 格式 Bearer token
     * @json_param 无
     * @return {"status":204,"message":"登出成功","data":""}
     * @remark 当未将Token以 Bearer的形式添加在HTTP请求头部，会报Unauthenticated.错误 HTTP码为500,以无效的Token再次请求也会报相同错误
     */
    public function logout()
    {
        \Auth::guard('api')->logout();
        return $this->apiReturn('',CodeEnum::LOGOUT_SUCCESS);
    }

    /**
     * showdoc
     * @catalog 接口文档/用户认证&权限管理
     * @title 刷新token
     * @description 当token在在有效期内，即将过期时，通过原有token换取新token的接口
     * @method post
     * @url {{host}}/api/authorizations/refresh
     * @header Authorization 必选  string 应用认证token 格式 Bearer token
     * @json_param 无
     * @return {"status":200,"message":"操作成功","data":{"access_token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC81OS4xMTAuMjEyLjExNjozMjgwMVwvYXBpXC9hdXRob3JpemF0aW9ucyIsImlhdCI6MTU4NjYwMTEyNiwiZXhwIjoxNTg2NjA0NzI2LCJuYmYiOjE1ODY2MDExMjYsImp0aSI6IlR6c25rQzVFVHc3UUJZUzYiLCJzdWIiOjM1LCJwcnYiOiJmNmI3MTU0OWRiOGMyYzQyYjc1ODI3YWE0NGYwMmI3ZWU1MjlkMjRkIn0.yEtMzMwShQR1pReHQ5gwUR2eWfaa-2AAt68bTmCgoKs","token_type":"Bearer","expires_in":3600}}
     * @return_param access_token string token
     * @return_param token_type string token类型
     * @return_param expires_in int token有效期(单位：秒)
     * @remark 当未将Token以 Bearer的形式添加在HTTP请求头部，会报Unauthenticated.错误 HTTP码为500，以无效的Token再次请求也会报相同错误，请求刷新Token之后，原Token值立即失效
     */
    public function refresh()
    {
        $token = \Auth::guard('api')->refresh();
        return $this->apiReturn([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
        ],CodeEnum::SUCCESS);
    }
}
