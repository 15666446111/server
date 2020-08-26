<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class PointProduct extends Model
{
	
    protected $table = 'point_products';
    

    protected $type  = [0 => '截图报单', 1 => '联系客服'];

    /**
     * @Author    Pudding
     * @DateTime  2020-08-05
     * @copyright [copyright]
     * @license   [license]
     * @version   [ 获取器 ]
     * @param     [type]      $value [description]
     * @return    [type]             [description]
     */
    public function getDemo()
    {
        return config('app.url').'/storage/uploads/'.$this->demo;
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
    public function getProductMoneyAttribute($value)
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
    public function setProductMoneyAttribute($value)
    {
    	$this->attributes['product_money'] = (int)($value * 100);
    }


    /**
     * @Author    Pudding
     * @DateTime  2020-08-05
     * @copyright [copyright]
     * @license   [license]
     * @version   [ 获取格式化后的金额 ]
     * @param     [type]      $value [description]
     */
    public function getProductMoneyFormat()
    {
        return number_format($this->product_money, 2, '.', ',');
    }

    /**
     * @Author    Pudding
     * @DateTime  2020-08-10
     * @copyright [copyright]
     * @license   [license]
     * @version   [ 获取兑换方式]
     * @return    [type]      [description]
     */
    public function getType()
    {
        return $this->type[$this->change_type];
    }


    /**
     * @Author    Pudding
     * @DateTime  2020-08-07
     * @copyright [copyright]
     * @license   [license]
     * @version   [ 关联订单表 ]
     * @return    [type]      [description]
     */
    public function banks()
    {
        return $this->belongsTo('\App\PointsBank', 'card_id', 'id');
    }

    /**
     * @Author    Pudding
     * @DateTime  2020-08-07
     * @copyright [copyright]
     * @license   [license]
     * @version   [ 关联订单表 ]
     * @return    [type]      [description]
     */
    public function orders()
    {
        return $this->hasMany('\App\PointsOrder', 'product_id', 'id');
    }
}
