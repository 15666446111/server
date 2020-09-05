<?php

namespace App\Jobs;

use App\BankCardOrder;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
//se App\Jobs\BankCardOrderNotify as Aglin;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class BankCardOrderNotify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * [$bankCardOrder 通知的订单 ]
     * @var [ORM]
     */
    protected $bankCardOrder;

    /**
     * 任务可以尝试的最大次数。
     *
     * @var int
     */
    public $tries = 1;


    /**
     * 任务可以执行的最大秒数 (超时时间)。
     *
     * @var int
     */
    public $timeout = 180;


    /**
     * 如果模型缺失即删除任务。
     *
     * @var bool
     */
    public $deleteWhenMissingModels = true;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(BankCardOrder $bankCardOrder)
    {
        $this->bankCardOrder = $bankCardOrder;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $Merchant = \App\MerchantSetting::where('merchant_number', $this->bankCardOrder->merchant)->first();

        if(empty($Merchant)){
            $this->bankCardOrder->notify_answ = "商户机构未找到!";
            $this->bankCardOrder->save();
            return false;
        }
        // 通知地址 
        if($Merchant->apply_card_notify_url == ""){
            $this->bankCardOrder->notify_answ = "未配置通知地址!";
            $this->bankCardOrder->save();
            return false;
        }

        $this->bankCardOrder->notify_url = $Merchant->apply_card_notify_url;

        // 创建http 通知client
        $client     = new Client();

        $content    = null;

        // 创建请求数据
        $args = array(
            'order_no'  =>  $this->bankCardOrder->order_no,
            'call_type' =>  $this->bankCardOrder->status == 0 ? 'ApplyCall' : 'HandleCall',
            'name'      =>  $this->bankCardOrder->name,
            'phone'     =>  $this->bankCardOrder->phone,
            'idcard'    =>  $this->bankCardOrder->idcard,
            'cardId'    =>  $this->bankCardOrder->card_id,
            'cardTitle' =>  $this->bankCardOrder->cards->title,
            'order_money'   => (int)$this->bankCardOrder->order_money * 100,
            'pip'       =>  $this->bankCardOrder->cards->getPip(),
            'card_pic'  =>  $this->bankCardOrder->cards->card_images,
            'ident'     =>  $this->bankCardOrder->ident,
            'merchant'  =>  $this->bankCardOrder->merchant,
        );

        // 如果是审核通知
        if($this->bankCardOrder->status != 0){
            $args['verfity_time']   = $this->bankCardOrder->verfity_time;
            $args['verfity_result'] = $this->bankCardOrder->status == '1' ? 'success' : 'fail';
            $args['order_remark']   = $this->bankCardOrder->order_remark;
            $args['pay_money']      = (int)$this->bankCardOrder->pay_money * 100;
        }

        try {

            ksort($args);

            $query = http_build_query($args);

            $queryString = $this->bankCardOrder->merchant.$query;

            $args['sign'] = md5($queryString);

            $result = $client->post($Merchant->apply_card_notify_url, [ 'json' => $args ]);

            $content = $result->getBody()->getContents();

            $this->bankCardOrder->notify_answ = json_encode($content).rand(10000, 99999);

            $this->bankCardOrder->nofity_count= $this->bankCardOrder->nofity_count + 1;

            $this->bankCardOrder->save();

            if($content != 'success'){

                if($this->bankCardOrder->nofity_count > 2 ){
                    $this->delete();
                }else{
                    $time = $this->bankCardOrder->nofity_count * 30;
                    $this->dispatch($this->bankCardOrder)->delay(now()->addMinutes($time));
                }
            } 

        } catch (\Exception $e) {
            $this->bankCardOrder->notify_answ = $e->getMessage();
            $this->bankCardOrder->save();
        }

    }
}
