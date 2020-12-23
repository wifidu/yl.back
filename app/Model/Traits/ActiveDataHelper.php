<?php
namespace App\Model\Traits;

use App\Model\MaterialIn;
use App\Model\MaterialOut;
use Illuminate\Support\Arr;
use Cache;
use Carbon\Carbon;
use DB;

trait ActiveDataHelper
{
    // 用于存放临时数据
    protected $materials = [];

    // 配置信息
    protected $out_weight  = 4; // 话题权重
    protected $in_weight   = 3; // 回复权重
    protected $pass_days   = 7; // 计算多少天内
    protected $data_number = 6; // 缓存多少条数据

    // 缓存相关配置
    protected $cache_key = 'active_material_';
    protected $cache_expire_in_seconds = 65 * 60;

    public function getActiveData()
    {
        // 尝试从缓存中取出cache_key对应的数据．如果能取到，便直接返回数据．
        // 否则运行匿名函数中的代码来取出来活跃用户的数据，返回时同时做了缓存．
        return Cache::remember($this->cache_key, $this->cache_expire_in_seconds, function(){
            return $this->calculateActiveData();
        });
    }
    public function calculateAndCacheActiveData()
    {
        // 取得活跃用户列表
        $active_data = $this->calculateActiveData();
        // 缓存
        // dd(Cache::get($this->cache_key. '12', 'nothing'));
        $this->cacheActiveData($active_data);
    }

    public function calculateActiveData()
    {
        $this->calculateMaterialInScore();
        $this->calculateMaterialOutScore();

        // 数组按照得分排序
        $materials = Arr::sort($this->materials, function ($material){
            return $material['score'];
        });

        // 我们需要的是排序，高分靠前，第二个参数为保持数组的key不变
        $materials = array_reverse($materials, true);

        // 只获取我们想要的数量
        $materials = array_slice($materials, 0, $this->data_number, true);

        // dd($materials);

        // 新建一个空集合
        $active_data = collect();
        foreach ($materials as $material_id => $material){
            $material = $this->find($material_id);
            if ($material){
                $active_data->push($material);
            }
        }

        return $active_data;
    }

    public function calculateMaterialInScore()
    {
        $in_data = MaterialIn::query()->select(DB::raw('material_id, count(*) as in_count'))
                        ->where('created_at', '>=', Carbon::now()->subDays($this->pass_days))
                        ->groupBy('material_id')
                        ->get();
        // dd($in_data->toArray());
        // 计算得分
        foreach ($in_data as $value){
            $this->materials[$value->material_id]['score'] = $value->in_count * $this->in_weight;
        }
    }

    public function calculateMaterialOutScore()
    {
        $out_data = MaterialOut::query()->select(DB::raw('material_id, count(*) as out_count'))
                        ->where('created_at', '>=', Carbon::now()->subDays($this->pass_days))
                        ->groupBy('material_id')
                        ->get();
        // dd($out_data->toArray());
        // 根据回复数量计算得分
        foreach ($out_data as $value){
            $out_score = $value->out_count * $this->reply_weight;
            if (isset($this->materials[$value->material_id])){
                $this->materials[$value->material_id]['score'] += $out_score;
            }else{
                $this->materials[$value->material_id]['score'] = $out_score;
            }
        }
    }

    public function cacheActiveData($active_data)
    {
        // dd($active_data->toArray());
        // 将数据放入缓存中
        foreach ($active_data as $data){
            Cache::put($this->cache_key. $data['id'], $data, $this->cache_expire_in_seconds);
        }
    }

}

?>
