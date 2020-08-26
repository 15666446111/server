<?php

namespace App\Observers;

use App\BankCardOrder;

class BankCardOrderObserver
{
    /**
     * 监听数据创建后的事件。
     *
     * @param  User $user
     * @return void
     */
    public function created(BankCardOrder $order)
    {
    	
    }
}
