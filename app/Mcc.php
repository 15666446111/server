<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Mcc extends Model
{

    // 黑名单
    protected $guarded = [];   

    /**
     * @Author    Pudding
     * @DateTime  2020-09-01
     * @copyright [copyright]
     * @license   [license]
     * @version   [ 关联商户表 ]
     * @return    [type]      [description]
     */
    public function merchants()
    {
    	return $this->hasMany('App\MerchantsImport', 'merchant_mcc', 'mcc');
    }
}
