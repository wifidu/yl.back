<?php

namespace App\Jobs;

use App\Model\BookBed;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Appointment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order, $delay)
    {
        $this->order = $order;
        // $this->delay($delay);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return $this->store($this->order);
        // // 通过事务执行 sql
        // \DB::transaction(
        //     function () {
        //         // 将订单的 closed 字段标记为 true, 即关闭订单
        //         $this->order->update(['closed' => true]);
        //         // 循环遍历订单中的商品 SKU，将订单中的数量加回到 SKU 的库存中去
        //         foreach ($this->order->items as $item) {
        //             $item->productSku->addStock($item->amount);
        //             // 当前订单类型是秒杀订单，并且对应商品是上架且尚未截止时间
        //             if ($item->order->type === Order::TYPE_SECKILL && $item->product->on_sale && !$item->product->seckill->is_after_end) {
        //                 // 将 Redis 中的库存 + 1
        //                 Redis::incr('seckill_sku_'.$item->productSku->id);
        //             }
        //         }
        //
        //         // 在自动关闭订单时，如果使用优惠券则将该优惠券的用量减少
        //         if ($this->order->couponCode) {
        //             $this->order->couponCode->changeUsed(false);
        //         }
        //     }
        // );

    }

    public function store($params)
    {
        $id = $params['id'] ?? '';
        $is_check = $params['is_checkin'] ?? 0;

        return BookBed::query()
            ->updateOrCreate(['id' => $id, 'is_checkin' => $is_check], $params);
    }
}
