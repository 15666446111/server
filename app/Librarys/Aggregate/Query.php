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

		$result = $this->send($bodyData);

		$result = json_decode($result);

		if($result->code == "000000"){
			//dd($result);
			$this->data->merchant_name 		= $result->mercCnm;
			$this->data->merchant_name_attr = $result->mercAbbr;
			$this->data->type				= $result->mchType;
			$this->data->debit_fee 			= intval($result->debitFee * 10000);
			$this->data->debit_fee_limit 	= intval($result->debitFeeLimit * 100);
			$this->data->credit_fee 		= intval($result->creditFee * 10000);
			$this->data->d0_fee 			= intval($result->d0Fee * 10000);
			$this->data->d0_fee_quota 		= intval($result->d0FeeQuota * 100);
			$this->data->union_credit_fee 	= intval($result->unionCreditFee * 10000);
			$this->data->union_debit_fee 	= intval($result->unionDebitFee * 10000);
			$this->data->ali_fee 			= intval($result->aliFee * 10000);
			$this->data->wx_fee 			= intval($result->wxFee * 10000);
			$this->data->state 				= $result->audSts;
			$this->data->status 			= $result->mchStatus == "1" ? 0 : 1;
			$this->data->sett_state 		= $result->settStatus == "1" ? 0 : 1;
			$this->data->save();

			return response()->json([
				'message' 		=> 'success', 
				'code' 			=> 10000, 
				'merchant_name' => $result->mercCnm, 
				'merchant_name_attr' => $result->mercAbbr, 
				'type' 				=> $result->mchType, 
				'debit_fee' 		=> $this->data->debit_fee, 
				'debit_fee_limit'	=>	$this->data->debit_fee_limit,
				'credit_fee'		=>  $this->data->credit_fee,
				'd0_fee'			=>	$this->data->d0_fee,
				'd0_fee_quota'		=>	$this->data->d0_fee_quota,
				'union_credit_fee'	=>	$this->data->union_credit_fee,
				'union_debit_fee'	=>	$this->data->union_debit_fee,
				'ali_fee'	=>	$this->data->ali_fee,
				'wx_fee'	=>	$this->data->wx_fee,
				'state'		=>	$this->data->state,
				'status'	=>	$this->data->status,
				'sett_state'=>	$this->data->sett_state
			]);

		}else{
			return response()->json(['message'=> $result->msg, 'code' => 10089]);
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

