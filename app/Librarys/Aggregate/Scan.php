<?php

namespace App\Librarys\Aggregate;

use GuzzleHttp\Client as GuzzClient;

class Scan
{
	/**
	 * [$merchant 商户机构号]
	 * @var [string]
	 */
	protected	$merchant;

	/**
	 * [$rsaKey 渠道密钥]
	 * @var [string]
	 */
	protected	$rsaKey;


	/**
	 * [$requestUrl 申请地址url ]
	 * @var [type]
	 */
	protected 	$requestUrl;


	/**
	 * [$privateStr 商户私钥]
	 * @var [type]
	 */
	protected 	$privateStr;


	//http://116.228.47.74:18480/merchant_agent_foreign  进件接口地址
	//https://116.228.47.74:7443/transaction_agent/scan/trans 扫码接口地址
	//https://116.228.47.74:7443/transaction_agent/scan/separ 分账接口地址

	public function __construct()
	{
		$this->merchant = config('aggregate.merchantNo');

		$this->rsaKey   = config('aggregate.rsaKey');

		$this->requestUrl = config('aggregate.requestUrl');

		$this->privateStr = config('aggregate.privateStrMake');
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
	public function sacn()
	{

		$url = 'https://116.228.47.74:7443/transaction_agent/scan/trans';
		$orderNo = "A".time();

		$bodyData = array(
			'mer_order_no'		=>	$orderNo,		//商户订单号 由请求方产生，必须唯一
			'trancde'			=>	'P00',			//交易码 P03 微信动态码 P04 云闪付二维码 P05 支付宝动态码
			'bar_code'			=>	'287033009178220894',				//付款码 用户云闪付、支付宝、微信 APP 生 成的付款码
			'pay_amount'		=>	1,			//订单总金额 分
			'order_name'		=>	"testName",		//订单名称
		);

		$this->send($url, $bodyData);
	}


	/**
	 * @Author    Pudding
	 * @DateTime  2020-08-25
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ 扫码的订单状态查询 ]
	 * @return    [type]      [description]
	 */
	public function query()
	{
		$url = 'https://116.228.47.74:7443/transaction_agent/scan/trans';

		$orderNo = "A1598005627";

		$bodyData = array(
			'mer_order_no'		=>	$orderNo,		//商户订单号(原交易
			'trancde'			=>	'PF0'
		);

		$this->send($url, $bodyData);
	}



	/**
	 * @Author    Pudding
	 * @DateTime  2020-08-18
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ 信息发送请求 ]
	 * @return    [type]      [description]
	 */
	public function send($url, $data)
	{	

		$head = [
			'merc_id'	=>	'999451957320001',//商户号
			'trm_sn'	=>	'ABC12345', //机具编号 N 智能 POS 终端的机具 SN 号 消费交易 9.1.13、9.1.14 必送， 9.1.15-9.1.19 对应的原交易为 9.1.13 或 9.1.14 时必送，9.1.20、 9.1.24.3 非必传
			'trm_id'	=>	'07109042',// 终端号 N 上送说明: 消费交易 9.1.13、9.1.14 必送， 9.1.15-9.1.19 对应的原交易为 9.1.13 或 9.1.14 时必送，9.1.20、 9.1.24.3 非必传
			'send_time'	=>	date('YmdHis', time()), //交易发起时间
			'org_id'	=>	'999',//机构号
			'charset'	=>	'UTF-8',
			'version'	=>	'1.0',
		];

		/**
		 * 进件参数加密
		 */
		$head['sign'] = $this->makeSign($data, $head);
		$head['sign_type'] = 'RSA';

		$param = array('head' => $head, 'body' => $data);

		echo json_encode($param);

		$client     = new GuzzClient(['verify' => false ]);

		$result 	= $client->request('POST', $url, [	
		    'json' 		=> 	$param,
		]);

        $content 	= $result->getBody()->getContents();

        dd($content);
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

		foreach ($params as $key => $value) {
			if($value == "" && $value !== 0) unset($params[$key]);
			if(in_array($key, ['SFZ1', 'SFZ2', 'YHK', 'CDMT1'])) unset($params[$key]);
		}

		ksort($params);

		$requestString = "";
		foreach( $params as $k => $v ) {
	       $requestString .= $k . '=' . $v . '&';
	   	}
	   	$requestString = rtrim($requestString,'&');

	   	$str = chunk_split($this->privateStr, 64, "\n"); 	// $privateStr 机构私钥--自行在类中或者文件中封装
	   	
	   	$private_key = "-----BEGIN RSA PRIVATE KEY-----\n$str-----END RSA PRIVATE KEY-----";
	   	
	   	$pi_key =  openssl_get_privatekey($private_key);
	   	
	   	openssl_sign($requestString, $binary_signature, $pi_key, 'SHA256');
	   	
	   	openssl_free_key($pi_key);

	   	return base64_encode ($binary_signature);
	}
}

