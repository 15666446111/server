<?php

namespace App\Librarys\Aggregate;

use GuzzleHttp\Client as GuzzClient;

class Edit
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

		$this->privateStr = config('aggregate.privateStr');
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
	public function edit()
	{

		$url = 'http://116.228.47.74:18480/merchant_agent_foreign'.'/rest/microMerchant/update';

		$orderNo = "A".time();

		file_put_contents("./a.text", $orderNo);

		$bodyData = array(
			'orgNumber'		=>	'999',
			'seqNo'			=>	$orderNo,
			'updType'		=>	'3',
			'mercId'		=>	'999451957320001',//电银商户号

			'debitFee'		=>	'0.0039',
			'debitFeeLimit'	=>	'5.3',
			'creditFee'		=>	'0.0039',
			'd0Fee'			=>	'0',
			'FeeQuota'		=>	'0.0039',
			'unionCreditFee'=>	'0.0039',
			'unionDebitFee'	=>	'0.0039',
			'aliFee'		=>	'0.0039',
			'wxFee'			=>	'0.0039'
		);

		$this->send($url, $bodyData);
	}


	/**
	 * @Author    Pudding
	 * @DateTime  2020-08-25
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ 标准商户修改]
	 * @return    [type]      [description]
	 */
	public function bzEdit()
	{

		$url = 'http://116.228.47.74:18480/merchant_agent_foreign'.'/rest/standardMerchant/update';

		$orderNo = "A".time();

		$bodyData = array(
			'orgNumber'		=>	'999',
			'seqNo'			=>	$orderNo,
			'updType'		=>	'3',
			'mercId'		=>	'999451658130004',//电银商户号

			'debitFee'		=>	'0.0036',
			'debitFeeLimit'	=>	'5.3',
			'creditFee'		=>	'0.0036',
			'd0Fee'			=>	'0',
			'FeeQuota'		=>	'0.0036',
			'unionCreditFee'=>	'0.0036',
			'unionDebitFee'	=>	'0.0036',
			'aliFee'		=>	'0.0036',
			'wxFee'			=>	'0.0036'
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
		/**
		 * 进件参数加密
		 */
		$data['sign'] = $this->editSign($data);

		echo(json_encode($data));
		//dd($head);
		$arrs = array();
		foreach ($data as $key => $value) {

			$arrs[] = array('name' => $key, 'contents' => in_array($key, ['SFZ1', 'SFZ2', 'YHK', 'CDMT1']) ? fopen($value, 'r') : $value);
			
		}
		//dd($arrs);
		//dd($arrs);
		

		$client     = new GuzzClient();

		$result 	= $client->request('POST', $url, [
		    'multipart' => $arrs,
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
	public function editSign($params)
	{
		foreach ($params as $key => $value) {
			if($value == "" && $value !== 0) unset($params[$key]);
			if(in_array($key, ['SFZ1', 'SFZ2', 'YHK', 'CDMT1'])) unset($params[$key]);
		}

		ksort($params);

		$params = json_encode($params, JSON_UNESCAPED_UNICODE);

	   	$str = chunk_split($this->privateStr, 64, "\n"); 	// $privateStr 机构私钥--自行在类中或者文件中封装
	   	
	   	$private_key = "-----BEGIN RSA PRIVATE KEY-----\n$str-----END RSA PRIVATE KEY-----";
	   	
	   	$pi_key =  openssl_get_privatekey($private_key);
	   	
	   	openssl_sign($params, $binary_signature, $pi_key, OPENSSL_ALGO_MD5);
	   	
	   	openssl_free_key($pi_key);

	   	return base64_encode ($binary_signature);
	}
}

