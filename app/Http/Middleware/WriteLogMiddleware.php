<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class WriteLogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        file_put_contents('request.log',$request);
//        file_put_contents('request.log',$request->path());
//        return $next($request);

//        $data = [
//            'request' => $request,
//            'url' => $request->path(),
//            'method' => $request->getRealMethod(),
//            'cookies' => $request->cookie(),
//            'content' => json_encode($request->all()),
//            'created_at' => time(),
//            'updated_at' => time(),
//        ];
//        Log::info(json_encode($data,256));
        return $next($request);

    }
}
