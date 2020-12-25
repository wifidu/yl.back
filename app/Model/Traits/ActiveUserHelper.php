<?php
namespace App\Model\Traits;

use App\Model\CreditManagement;
use App\Model\Refund;
use Illuminate\Support\Arr;
use Cache;
use Carbon\Carbon;
use DB;

trait ActiveUserHelper
{
    // 用于存放临时数据
    protected $users = [];

    // 配置信息
    protected $collect_weight  = 4; // 收款账单权重
    protected $refund_weight   = 3; // 退款账单权重
    protected $pass_days   = 7; // 计算多少天内
    protected $user_number = 6; // 缓存多少条数据

    // 缓存相关配置
    protected $cache_key = 'active_user_';
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
        // dd(Cache::get($this->cache_key . '16', 'nothing'));
        $this->cacheActiveData($active_data);
    }

    public function calculateActiveData()
    {
        $this->calculateCollectScore();
        $this->calculateRefundScore();

        // 数组按照得分排序
        $users = Arr::sort($this->users, function ($user){
            return $user['score'];
        });

        // 我们需要的是排序，高分靠前，第二个参数为保持数组的key不变
        $users = array_reverse($users, true);

        // 只获取我们想要的数量
        $users = array_slice($users, 0, $this->data_number, true);

        // dd($users);

        // 新建一个空集合
        $active_data = collect();
        foreach ($users as $account_id => $user){
            $user = $this->find($account_id);
            if ($user){
                $active_data->push($user);
            }
        }

        return $active_data;
    }

    public function calculateCollectScore()
    {
        $collect_data = CreditManagement::query()->select(DB::raw('account_id, count(*) as collect_count'))
                        ->where('created_at', '>=', Carbon::now()->subDays($this->pass_days))
                        ->groupBy('account_id')
                        ->get();
        // dd($collect_data->toArray());
        // 计算得分
        foreach ($collect_data as $value){
            $this->users[$value->account_id]['score'] = $value->collect_count * $this->collect_weight;
        }
    }

    public function calculateRefundScore()
    {
        $refund_data = Refund::query()->select(DB::raw('account_id, count(*) as refund_count'))
                        ->where('created_at', '>=', Carbon::now()->subDays($this->pass_days))
                        ->groupBy('account_id')
                        ->get();
        // dd($refund_data->toArray());
        // 根据回复数量计算得分
        foreach ($refund_data as $value){
            $refund_score = $value->refund_count * $this->refund_weight;
            if (isset($this->users[$value->account_id])){
                $this->users[$value->account_id]['score'] += $refund_score;
            }else{
                $this->users[$value->account_id]['score'] = $refund_score;
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
