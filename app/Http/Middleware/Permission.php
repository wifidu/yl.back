<?php

namespace App\Http\Middleware;

use Closure;
use App\Enum\CodeEnum;
use App\Traits\ApiTraits;
use Illuminate\Contracts\Auth\Access\Gate;

class Permission
{

    use ApiTraits;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 获取当前路径中的模块部分
        $path = $request->segments()[1];
        // 获取当前用户信息
        $user = \Auth::guard('api')->user();
        // 对用户权限检测
        $permisson = app(Gate::class)->forUser($user)->check($path);
        // 用户检测通过可以继续路由
        if ($permisson) {
            return $next($request);
        }else{
            // 用户检测不通过则返回`权限不足`
            return $this->apiReturn('',CodeEnum::NOT_PERMISSION);
        }
    }
}
