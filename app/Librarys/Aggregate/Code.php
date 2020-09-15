<?php

namespace App\Librarys\Aggregate;

use App\CodeOrder;
use GuzzleHttp\Client as GuzzClient;

class Code
{

	/**
	 * [$url 请求的url 地址 ]
	 * @var [ string ]
	 */
	protected	$url;

	/**
	 * [$data 商户提交的进件信息 ]
	 * @var [ merchants orm ]
	 */
	protected 	$data;

	/**
	 * @Author    Pudding
	 * @DateTime  2020-09-03
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ init ]
	 */
	public function __construct(CodeOrder $params)
	{
		$this->data = $params;

		$this->url   = "https://pos.chinaebi.com:7443/transaction_agent/scan/trans";
	}


	/**
	 * @Author    Pudding
	 * @DateTime  2020-08-18
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ 用户必须首先进件 ]
	 * @param     Request     $request [description]
	 * @return    [type]               [description]
	 */
	public function make()
	{
		$bodyData = array(
			'mer_order_no'		=>	$this->data->order_no,				//商户订单号 由请求方产生，必须唯一
			'trancde'			=>	$this->data->type,					//交易码 P03 微信动态码 P04 云闪付二维码 P05 支付宝动态码
			'pay_amount'		=>	$this->data->money,					//订单总金额 分
			'notify_url'		=>	env('APP_URL')."/payCallback",		//后台回调地址 支付成功后通知商户系统支付结果
		);

		$result = $this->send($bodyData);

		$this->data->dy_return = $result;

		$result = json_decode($result);

		if($result->head->res_code == "00" && $result->body->code_url){
			$this->data->code_url = $result->body->code_url;
			$this->data->state = 1;
			$this->data->save();
			return response()->json(['message'=> 'success', 'code' => 10000, 'url' => $result->body->code_url]);
		}else{
			$this->data->state = -1;
			$this->data->save();
			return response()->json(['message'=> $result->head->res_msg, 'code' => 10078]);
		}
	}


	/**
	 * @Author    Pudding
	 * @DateTime  2020-08-18
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ 信息发送请求 ]
	 * @return    [type]      [description]
	 */
	public function send( $data )
	{	

		$termial = \App\MerchantTemial::where('dy_term_no', $this->data->term_no)->where('merc_no', $this->data->merchant_number)->value('sn');

		$head = [
			'merc_id'	=>	$this->data->merchant_number,					//商户号
			'trm_sn'	=>	$termial, 										//机具编号 N 智能 POS 终端的机具 SN 号 消费交易 9.1.13、9.1.14 必送， 9.1.15-9.1.19 对应的原交易为 9.1.13 或 9.1.14 时必送，9.1.20、 9.1.24.3 非必传
			'trm_id'	=>	$this->data->term_no,							// 终端号 N 上送说明: 消费交易 9.1.13、9.1.14 必送， 9.1.15-9.1.19 对应的原交易为 9.1.13 或 9.1.14 时必送，9.1.20、 9.1.24.3 非必传
			'send_time'	=>	date('YmdHis', time()), 						//交易发起时间
			'org_id'	=>	config('aggregate.orgNumber'),					//机构号
			'charset'	=>	'UTF-8',
			'version'	=>	'1.0',
		];

		/**
		 * 进件参数加密
		 */
		$head['sign'] = $this->makeSign($data, $head);

		$head['sign_type'] = 'RSA';

		$param = array('head' => $head, 'body' => $data);

		$client     = new GuzzClient(['verify' => false ]);

		$result 	= $client->request('POST', $this->url, [ 'json' => $param ]);

        return $result->getBody()->getContents();
	}


	/**
	 * @Author    Pudding
	 * @DateTime  2020-08-18
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ 进件参数加密 ]
	 * @param     [type]      $params [description]
	 * @return    [type]              [description]
	 */
	public function makeSign($params, $head)
	{

		$params = array_merge($params, $head);

		$private_key = file_get_contents(storage_path('app/public/rsa/pay/rsa_private_key.pem'));

		foreach ($params as $key => $value) {
			if($value == "" && $value !== 0) unset($params[$key]);
		}

		ksort($params);

		$requestString = "";
		foreach( $params as $k => $v ) {
	       $requestString .= $k . '=' . $v . '&';
	   	}

	   	$requestString = rtrim($requestString,'&');

	   	$pi_key =  openssl_get_privatekey($private_key);
	   	
	   	openssl_sign($requestString, $binary_signature, $pi_key, 'SHA256');
	   	
	   	openssl_free_key($pi_key);

	   	return base64_encode($binary_signature);
	}
}

