<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;

class PointChangeController extends Controller
{
	/**
	 * [$merchant 商户编号]
	 * @var [string]
	 */
	protected $merchant;

	/**
	 * [$ident 唯一标识]
	 * @var [string]
	 */
	protected $ident;
    

	/**
	 * @Author    Pudding
	 * @DateTime  2020-08-07
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ 初始化方法 ]
	 */
	public function __construct(Request $request)
	{
		if(!$request->merchant or !$request->ident) abort(404);
		
		$Merchant = \App\MerchantSetting::where('merchant_number', $request->merchant)->first();
		if(empty($Merchant)) abort(404);
		if(!in_array('pointsChange',json_decode($Merchant->merchant_ability, true))) abort(404);
	
		$this->merchant = $request->merchant;

		$this->ident    = $request->ident;
	}

	/**
	 * @version [<vector>] [< 获取可用于积分兑换的银行列表 >]
	 * @author  [name] <[< 755969423@qq.com >]>
	 */
    public function bankList(Request $request)
    {
		$list = \App\PointsBank::where('status', 1)->orderBy('sort', 'desc')->get();

		return view('Points.bankList', compact('list'));
    }


	/**
	 * @version [<vector>] [< 获取可用于积分兑换的银行列表 >]
	 * @author  [name] <[< 755969423@qq.com >]>
	 */
    public function productList(Request $request)
    {
		if(!$request->bankId) abort(404);

		$bank = \App\PointsBank::where('status', 1)->where('id', $request->bankId)->first();

		$product = \App\PointProduct::where('card_id', $request->bankId)->where('status', 1)->orderBy('sort', 'desc')->get();

		return view('Points.product', compact('bank', 'product'));
    }


	/**
	 * @version [<vector>] [< 兑换的积分产品详情 >]
	 * @author  [name] <[< 755969423@qq.com >]>
	 */
    public function productDetail(Request $request)
    {
    	if(!$request->product) abort(404);

    	$product = \App\PointProduct::where('id', $request->product)->where('status', 1)->first();

    	return view('Points.details', compact('product'));
    }


	/**
	 * @version [<vector>] [< 报单展示页面 >]
	 * @author  [name] <[< 755969423@qq.com >]>
	 */
    public function productSub(Request $request)
    {
    	if(!$request->product) abort(404);

    	$product = \App\PointProduct::where('id', $request->product)->where('status', 1)->first();
    	if(empty($product)) abort(404);

    	$productList = \App\PointProduct::where('card_id', $product->card_id)->where('status', 1)->orderBy('sort', 'desc')->get();

    	return view('Points.sub', compact('product', 'productList'));
    }


    /**
	 * @version [<vector>] [< 提交报单资料 >]
	 * @author  [name] <[< 755969423@qq.com >]>
	 */
    public function subOrder(Request $request)
    {
    	//dd( $request );
    	if(!$request->product) return json_encode(['code' => 10010, 'message' => '请选择产品!']);
    	if(!$request->code)	return json_encode(['code' => 10010, 'message' => '请填写兑换短信!']);

    	$product = \App\PointProduct::where('id', $request->product)->where('status', 1)->first();
    	if(empty($product)) return json_encode(['code' => 10010, 'message' => '产品选择有误!']);


    	$path = "";
    	// 如果有截图
    	if($request->hasFile('voucher') && $request->file('voucher')->isValid()){
    		$file 			= $request->file('voucher');
    		$fileextension 	= $file->getClientOriginalExtension();
    		if(!in_array($fileextension,['jpg', 'jpeg', 'png', 'bmp'])) return json_encode(['code' => 10010, 'message' => '图片格式不对!']);
    		$filename = sha1($file->getClientOriginalName().time().rand(1000,9999)).'.'.$file->getClientOriginalExtension();
    		Storage::disk('points')->put($filename, file_get_contents($request->file('voucher') ->path()));
    		$path = 'points/'.$filename;
    	}

    	// 生成一个订单
    	$order = \App\PointsOrder::create([
    		'order_no'	=> strtoupper(dechex(date('m'))).date('d').substr(time(), -5).substr(microtime(),2,5).sprintf('%02d',rand(0,99)),
    		'product_id'=> $request->product,
    		'order_pic'	=> $path,
    		'content'	=> $request->code,
    		'order_money' => $product->product_money,
    		'pay_money'	=> $product->product_money,
    		'order_remark' => $request->msg,
    		'ident'		=> $request->ident,
    		'merchant'	=> $request->merchant
    	]);

    	if($order) return json_encode(['code' => 10000, 'message' => '报单成功!']); 

    	return json_encode(['code' => 10012, 'message' => '报单失败,请稍后再试!']);
    }
}
