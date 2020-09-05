<?php

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;
use Illuminate\Support\Str;
use App\Jobs\BankCardOrderNotify;
use Dcat\Admin\Models\Administrator;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
use Maatwebsite\Excel\Validators\ValidationException;

class HandleBankcardForm extends Form
{

    protected $id;

    protected $max;
    
    public function __construct($id = null)
    {
        $this->id = $id;

        parent::__construct();
    }

    // 处理请求
    public function handle(array $input)
    {

        $info = \App\BankCardOrder::where('id', $input['id'])->first();
        
        $info->status = $input['state'];

        $info->verfity_time = date('Y-m-d H:i:s', time());

        $info->order_remark = $input['remark'];

        $info->pay_money = $input['real_money'];

        $info->nofity_count = 0;

        $info->save();

        BankCardOrderNotify::dispatch($info)->onQueue('small_server_apply_bankcard_notify');
    }


    public function form()
    {
        $this->hidden('id');

        $this->select('state', '操作')->options([1=> '通过审核', -1=>'审核拒绝'])->required();

        $this->text('remark', '原因')->help('当审核拒绝时,请填写失败原因!');

        $this->currency('real_money', '奖励')->symbol('￥')->help('当成功时,实际发放的奖励,最高不能超过订单金额!');

    }

    // 返回表单数据，如不需要可以删除此方法
    public function default()
    {
        $info = \App\BankCardOrder::where('id', $this->id)->first();

        return [ 'id' =>  $this->id ,'real_money' => $info->order_money ];
    }
}