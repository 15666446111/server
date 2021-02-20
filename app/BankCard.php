<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankCard extends Model
{

    /**
     * [$pips 奖励发放标准]
     * @var [array]
     */
    protected $pips = [ 1=> '下卡', 2=> '下卡并首刷', 3=>'其他' ];

	/**
	 * @Author    Pudding
	 * @DateTime  2020-08-05
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ 获取器 ]
	 * @param     [type]      $value [description]
	 * @return    [type]             [description]
	 */
    public function getMoneyAttribute($value)
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
    public function setMoneyAttribute($value)
    {
    	$this->attributes['money'] = (int)($value * 100);
    }

    /**
     * @Author    Pudding
     * @DateTime  2020-08-06
     * @copyright [copyright]
     * @license   [license]
     * @version   [获取格式化后的金额]
     * @param     [type]      $value [description]
     * @return    [type]             [description]
     */
    public function getMoneyFormat()
    {
        return number_format($this->money, 2, '.', ',');
    }

    /**
     * @Author    Pudding
     * @DateTime  2020-08-06
     * @copyright [copyright]
     * @license   [license]
     * @version   [ 获取图片地址 ]
     * @param     [type]      $value [description]
     * @return    [type]             [description]
     */
    public function getCardImages()
    {
        return config('app.url').'/storage/uploads/applyCards/'.$this->card_images;
    }

    /**
     * @Author    Pudding
     * @DateTime  2020-08-06
     * @copyright [copyright]
     * @license   [license]
     * @version   [ 获取图片地址 ]
     * @param     [type]      $value [description]
     * @return    [type]             [description]
     */
    public function getIcon()
    {
        return config('app.url').'/storage/uploads/applyCards/'.$this->icon;
    }

    /**
     * @Author    Pudding
     * @DateTime  2020-08-06
     * @copyright [copyright]
     * @license   [license]
     * @version   [ 获取卡片的第一个亮点 ]
     * @return    [type]      [description]
     */
    public function getFirstLigHeight()
    {
        return json_decode($this->ligheight, true)[0];
    }


    /**
     * @Author    Pudding
     * @DateTime  2020-08-06
     * @copyright [copyright]
     * @license   [license]
     * @version   [ 获取卡片的所有亮点 ]
     * @return    [type]      [description]
     */
    public function getLigHeight()
    {
        return json_decode($this->ligheight, true);
    }


    /**
     * @Author    Pudding
     * @DateTime  2020-08-06
     * @copyright [copyright]
     * @license   [license]
     * @version   [ 获取奖励标准 ]
     * @return    [type]      [description]
     */
    public function getPip()
    {
        return $this->pips[$this->pip];
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
        return $this->hasMany('\App\BankCardOrder', 'card_id', 'id');
    }
}
