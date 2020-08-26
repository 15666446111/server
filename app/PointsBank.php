<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class PointsBank extends Model
{
	
    protected $table = 'points_banks';
    
    
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
    public function getIcon()
    {
        return config('app.url').'/storage/uploads/'.$this->icon;
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
}
