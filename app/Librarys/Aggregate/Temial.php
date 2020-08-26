<?php

namespace App\Librarys\Aggregate;

use GuzzleHttp\Client as GuzzClient;

class Temial
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


	protected   $mer_id;

	//http://116.228.47.74:18480/merchant_agent_foreign  进件接口地址
	//https://116.228.47.74:7443/transaction_agent/scan/trans 扫码接口地址
	//https://116.228.47.74:7443/transaction_agent/scan/separ 分账接口地址

	public function __construct()
	{
		$this->merchant = config('aggregate.merchantNo');

		$this->rsaKey   = config('aggregate.rsaKey');

		$this->requestUrl = config('aggregate.requestUrl');

		$this->privateStr = config('aggregate.privateStr');

		$this->mer_id  	  = '999451957320001'; 
	}


	/**
	 * @Author    Pudding
	 * @DateTime  2020-08-18
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ 终端绑定 ]
	 * @param     Request     $request [description]
	 * @return    [type]               [description]
	 */
	public function bind()
	{

		$url = 'http://116.228.47.74:18480/merchant_agent_foreign'.'/rest/terminal/stdBinding';

		$orderNo = "A".time();

		file_put_contents("./a.text", $orderNo);

		$bodyData = array(
			'orgNumber'		=>	'999',

			'tsn'			=>	'ABC123456',

			'dyMchNo'		=>	$this->mer_id,

			'snSource'		=>	'1', //机具来源 1 – 外部代理商(默认) 2 – 电银代理商 (当机具来源为“电银代理商”时, 外部终 端号、终端厂家、终端型号非必传)

			'dyTermNo'		=> 	'90119288',   // 外部终端号 不超过8位。  返回。//。07109042

			'termFactory'	=>	'079',

			'termModel'		=>  '0013',

			'termName'		=>	'晨光电子批发', 		//门店名称

			'termAddress'	=>	'银座好望角1202', 	//门店地址
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
		$data['sign'] = $this->bindSign($data);

		echo json_encode($data);
		//dd($head);
		$arrs = array();
		foreach ($data as $key => $value) {

			$arrs[] = array('name' => $key, 'contents' => in_array($key, ['SFZ1', 'SFZ2', 'YHK', 'CDMT1']) ? fopen($value, 'r') : $value);
			
		}
		//dd($arrs);
		//dd($arrs);

		$client     = new GuzzClient();

		$result 	= $client->request('POST', $url, [
		    'json' => $data,
		]);

        $content 	= $result->getBody()->getContents();

        echo $content;
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
	public function bindSign($params)
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

