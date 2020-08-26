<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class BankCardOrder extends Model
{
    protected $table = 'bank_card_orders';
    
    // 黑名单
    protected $guarded = [];

	/**
	 * @Author    Pudding
	 * @DateTime  2020-08-05
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ 获取器 ]
	 * @param     [type]      $value [description]
	 * @return    [type]             [description]
	 */
    public function getOrderMoneyAttribute($value)
    {
    	return $value / 100;
    }

    /**
     * @Author    Pudding
     * @DateTime  2020-08-05
     * @copyright [copyright]
     * @license   [license]
     * @version   [ 设置器 ]
     * @param     [type]      $value [description]
     */
    public function setOrderMoneyAttribute($value)
    {
    	$this->attributes['order_money'] = (int)($value * 100);
    }

	/**
	 * @Author    Pudding
	 * @DateTime  2020-08-05
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ 获取器 ]
	 * @param     [type]      $value [description]
	 * @return    [type]             [description]
	 */
    public function getPayMoneyAttribute($value)
    {
    	return $value / 100;
    }

    /**
     * @Author    Pudding
     * @DateTime  2020-08-05
     * @copyright [copyright]
     * @license   [license]
     * @version   [ 设置器 ]
     * @param     [type]      $value [description]
     */
    public function setPayMoneyAttribute($value)
    {
    	$this->attributes['pay_money'] = (int)($value * 100);
    }

    /**
     * @Author    Pudding
     * @DateTime  2020-08-07
     * @copyright [copyright]
     * @license   [license]
     * @version   [ 关联订单表 ]
     * @return    [type]      [description]
     */
    public function cards()
    {
        return $this->belongsTo('\App\BankCard', 'card_id', 'id');
    }
}
