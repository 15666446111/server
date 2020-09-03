<?php

namespace App\Librarys\Aggregate;

use App\MerchantsImport;
use GuzzleHttp\Client as GuzzClient;

class Temial
{

	/**
	 * [$data 商户提交的进件信息 ]
	 * @var [ merchants orm ]
	 */
	protected 	$data;


	/**
	 * [$url 请求的url 地址 ]
	 * @var [ string ]
	 */
	protected	$url;


	/**
	 * @Author    Pudding
	 * @DateTime  2020-09-03
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ Class init for set params]
	 */
	public function __construct(MerchantsImport $params)
	{
		$this->data = $params;

		$this->url  = 'https://qzmerc.chinaebi.com:18480/merchant_agent_foreign'.'/rest/terminal/stdBinding';
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
		$bodyData = array(

			'orgNumber' 	=> 	config('aggregate.orgNumber'),

			'tsn'			=>	'ABC123456',

			'dyMchNo'		=>	$this->data->merchant_number,

			'snSource'		=>	'1', //机具来源 1 – 外部代理商(默认) 2 – 电银代理商 (当机具来源为“电银代理商”时, 外部终 端号、终端厂家、终端型号非必传)

			'dyTermNo'		=> 	'90119288',   // 外部终端号 不超过8位。  返回。//。07109042

			'termFactory'	=>	'079',

			'termModel'		=>  '0013',

			'termName'		=>	'晨光电子批发', 		//门店名称

			'termAddress'	=>	'银座好望角1202', 	//门店地址
		);

		$this->send($bodyData);
	}


	/**
	 * @Author    Pudding
	 * @DateTime  2020-08-18
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ 信息发送请求 ]
	 * @return    [type]      [description]
	 */
	public function send($data)
	{	
		/**
		 * 进件参数加密
		 */
		$data['sign'] = $this->bindSign($data);

		$arrs = array();

		foreach ($data as $key => $value) {

			$arrs[] = array('name' => $key, 'contents' => in_array($key, ['SFZ1', 'SFZ2', 'YHK', 'CDMT1']) ? fopen($value, 'r') : $value);
			
		}

		$client     = new GuzzClient();

		$result 	= $client->request('POST', $this->url, [ 'json' => $data ]);

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
	public function bindSign($params)
	{
		$private_key = file_get_contents(storage_path('app/public/rsa/net/rsa_private_key.pem'));

		foreach ($params as $key => $value) {
			if($value == "" && $value !== 0) unset($params[$key]);
		}

		ksort($params);

		$params = json_encode($params, JSON_UNESCAPED_UNICODE);

	   	$pi_key =  openssl_get_privatekey($private_key);
	   	
	   	openssl_sign($params, $binary_signature, $pi_key, OPENSSL_ALGO_MD5);
	   	
	   	openssl_free_key($pi_key);

	   	return base64_encode($binary_signature);
	}
}

