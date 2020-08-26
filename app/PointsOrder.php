<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class PointsOrder extends Model
{
	
    protected $table = 'points_orders';
    
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
     * @DateTime  2020-08-11
     * @copyright [copyright]
     * @license   [license]
     * @version   [ 关联产品表 ]
     * @return    [type]      [description]
     */
    public function products()
    {
        return $this->belongsTo('\App\PointProduct', 'product_id', 'id');
    }
}
