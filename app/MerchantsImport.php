<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class MerchantsImport extends Model
{
	
    protected $table = 'merchants_imports';

    // 黑名单
    protected $guarded = [];

    /**
     * @Author    Pudding
     * @DateTime  2020-09-01
     * @copyright [copyright]
     * @license   [license]
     * @version   [ 反向管理商户mcc类型表 ]
     * @return    [type]      [description]
     */
    public function mccs()
    {
    	return $this->belongsTo('App\Mcc', 'merchant_mcc', 'mcc');
    }
}
