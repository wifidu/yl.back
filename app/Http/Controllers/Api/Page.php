<?php
namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Cache;

Class Page{
    public function getpage(){
        return Cache::get('page');
    }
}
?>
