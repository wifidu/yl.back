<?php
namespace App\Http\Controllers\Api\MaterialManagement;

use Cache;
use Dingo\Api\Contract\Http\Request;

class CacheController
{

    public function flush()
    {
        Cache::flush();
        echo('缓存清空成功!');
    }

}

?>
