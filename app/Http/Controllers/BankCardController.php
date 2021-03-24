<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use GuzzleHttp\Client;
use App\Jobs\BankCardOrderNotify;

class BankCardController extends Controller
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
		
		if(!in_array('applyCard',json_decode($Merchant->merchant_ability, true))) abort(404);
	
		$this->merchant = $request->merchant;

		$this->ident    = $request->ident;
	}


	/**
	 * @version [<vector>] [< 获取可申请的银行卡列表 >]
	 * @author  [name] <[< 755969423@qq.com >]>
	 */
	public function cardList(Request $request)
	{
		$showprice = (!$request->showprice or $request->showprice != "n") ? 'y' : "n";

		$list = \App\BankCard::where('status', 1)->orderBy('sort', 'desc')->get();

		$info = array('merchant' => $this->merchant, 'ident' => $this->ident);

		return view('ApplyCard.list', compact('list', 'info', 'showprice'));
	}


	/**
	 * @Author    Pudding
	 * @DateTime  2020-08-06
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ 申请办卡 - 卡片详情 ]
	 * @param     Request     $request [description]
	 * @return    [type]               [description]
	 */
	public function cardDetail(Request $request)
	{
		if(!$request->cid) abort(404);

		$showprice = (!$request->showprice or $request->showprice != "n") ? 'y' : "n";

		$card = \App\BankCard::where('status', 1)->where('id', $request->cid)->first();

		$info = array('merchant' => $this->merchant, 'ident' => $this->ident);

		return view('ApplyCard.detail', compact('card', 'info', 'showprice'));
	}


	/**
	 * @Author    Pudding
	 * @DateTime  2020-08-07
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ 提交申请信息 前置资料 ]
	 * @param     Request     $request [description]
	 * @return    [type]               [description]
	 */
	public function cardApply(Request $request)
	{

		if(!$request->name or !preg_match('/^[\x7f-\xff]+$/', $request->name)){
			return json_encode(['code' => 10010, 'message' => '请检查申请人姓名']);
		} 

		if(!$request->phone or !preg_match("/^1[3456789]{1}\d{9}$/",$request->phone)){
			return json_encode(['code' => 10010, 'message' => '请检查预留手机号']);
		}

		if(!$request->idcard or !preg_match("/(^\d{15}$)|(^\d{17}([0-9]|X))$/isu", $request->idcard) ) {
			return json_encode(['code' => 10010, 'message' => '请检查身份证号']);
		}

		if(!$request->cardId){
			return json_encode(['code' => 10010, 'message' => '找不到产品!']);
		}

		$card = \App\BankCard::where('status', 1)->where('id', $request->cardId)->first();
		if(empty($card)){
			return json_encode(['code' => 10010, 'message' => '找不到产品!']);
		}


		// 获取用户最近有没有申请过此卡
		$last = \App\BankCardOrder::where('card_id', $request->cardId)->where('name', $request->name)->where('idcard', $request->idcard)->where('phone', $request->phone)->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())->count();
		if($last >= 1){
			return json_encode(['code' => 10020, 'message' => '此资料已于30天内提交过,请勿重复提交!']);
		}

		// 创建申请订单
		$order = \App\BankCardOrder::create([
			'order_no' 	=> strtoupper(dechex(date('m'))).date('d').substr(time(), -5).substr(microtime(),2,5).sprintf('%02d',rand(0,99)),
			'card_id'	=> $request->cardId,
			'name'		=> $request->name,
			'phone'		=> $request->phone,
			'idcard'	=> $request->idcard,
			'order_title'	=> $card->title,
			'order_money'	=> $card->money,
			'order_pip'		=> $card->pip,
			'order_pic'		=> $card->card_images,
			'pay_money'		=> $card->money,
			'ident'			=> $this->ident,
			'merchant'		=> $this->merchant,
		]);

		return json_encode(['code' => 10000, 'message' => '前置资料填写完成,请完成后续步骤']);

	}
}
