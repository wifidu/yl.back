<?php

namespace App\Traits;

/**
 * Trait ApiTraits：api处理
 * @package App\Traits
 * @author zhaodayuan
 * @date 2020/2/3
 */
Trait ApiTraits
{
    public function apiReturn($data = [], $codeEnum)
    {
        return [
            'status'    => (int) $codeEnum[0],
            'message'   => (string) $codeEnum[1],
            'data' => $data
        ];
    }

}
