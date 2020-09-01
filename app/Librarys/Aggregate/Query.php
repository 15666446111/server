<?php

namespace App\Librarys\Aggregate;

use App\MerchantsImport;
use GuzzleHttp\Client as GuzzClient;

class Query
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
	 * @DateTime  2020-09-01
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ init ]
	 * @param     MerchantsImport $params [description]
	 */
	public function __construct(MerchantsImport $params)
	{
		$this->data = $params;

		$this->url  = 'https://qzmerc.chinaebi.com:18480/merchant_agent_foreign'.'/rest/merchantInfo/query';
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
	public function query()
	{
		$bodyData = array('orgNumber' => config('aggregate.orgNumber'), 'dyMchNo' => $this->data->merchant_number );

		return $this->send($bodyData);
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
		$data['sign'] = $this->querySign($data);

		$arrs = array();

		foreach ($data as $key => $value) {
			$arrs[] = array('name' => $key, 'contents' => $value);
		}

		$client     = new GuzzClient();

		$result 	= $client->request('POST', $this->url, [ 'json' 	=> $data ]);

        $content 	= $result->getBody()->getContents();

        dd($content);

        return $content;
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
	public function querySign($params)
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

