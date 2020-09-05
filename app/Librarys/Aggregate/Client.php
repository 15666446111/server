<?php

namespace App\Librarys\Aggregate;

use DateTime;
use App\MerchantsImport;
use GuzzleHttp\Client as GuzzClient;

class Client
{

	/**
	 * [$data 商户提交的进件信息 ]
	 * @var [ merchants orm ]
	 */
	protected 	$data;


	/**
	 * [$url 进件请求的地址]
	 * @var [string]
	 */
	protected	$url;


	public function __construct(MerchantsImport $params)
	{
		$url 		= 'https://qzmerc.chinaebi.com:18480/merchant_agent_foreign';

		$this->data = $params;

		$this->url  = $this->data->type == '1' ? $url . '/rest/standardMerchant/inComing' : $url . '/rest/microMerchant/inComing';
	}


	/**
	 * @Author    Pudding
	 * @DateTime  2020-08-31
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ 根据不同的商户进件 执行不同的进件方法 ]
	 * @return    [type]      [description]
	 */
	public function run()
	{
		$result =  $this->data->type == "1" ? $this->bzNet() : $this->smallNet();

		$this->data->dy_return = $result;

		$result = json_decode($result);

		if($result->code == "000000"){

			$this->data->merchant_number = $result->mercId;

			$this->data->state = $result->mercSts;

			$this->data->save();

			// 需要压入队列器查询进件状态

			return response()->json(['message'=> '入网资料提交成功,等待审核!', 'code' => 10000, 'merchantId' => $result->mercId]);

		}else{

			$this->data->state = -1;	// -1为无效进件资料 失败的
			$this->data->save();
			return response()->json(['message'=> '商户入网失败!', 'code' => 10090]);

		}
	}


	/**
	 * @Author    Pudding
	 * @DateTime  2020-08-18
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ 小微商户进件 ]
	 * @param     Request     $request [description]
	 * @return    [type]               [description]
	 */
	public function smallNet()
	{
		$bodyData = array();

		return $this->send($bodyData);
	}



	/**
	 * @Author    Pudding
	 * @DateTime  2020-08-25
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ 标准商户进件 ]
	 * @return    [type]      [description]
	 */
	public function bzNet()
	{
		$bodyData = array(
			'entAccBnkNm'	=>	'123',									//企账户银行名称 商户性质为其他且结算账号 公私标志为对私或暂不结算-必 传
			'entAccNm'		=>	'123',									//企业账户名称 商户性质为其他且结算账号 公私标志为对私或暂不结算-必 传
			'entAccNo'		=>	'123',									//企业账号 商户性质为其他且结算账号 公私标志为对私或暂不结算-必 传
			'mercHotLin'	=>	$this->data->merchant_tel,				//座机电话
			'crpNm'			=>	$this->data->card_name,					//法人姓名
			'usrOprEmail'	=>	config('aggregate.userEmail'),			//商户管理员 EMAIL
			'mercAttr'		=>	'9',									//商户性质  1-标准商户(个体)  9-其他(企业)
			'regId'			=>	$this->data->reg_no,					//营业执照号
			'regExpDtD'		=>	$this->data->reg_expd,					//营业执照过期时间
			'crpIdTyp'		=>	'0',									//法人证件类型 0-身份证
			'stlSign'		=>	'1',									//结算账号公私标志 0-对公 1-对私(法人) 2-暂不结算
			'aliFlg'		=>	'0',									//是否开通支付宝
			'wxFlg'			=>	'0',									//是否开通微信
			'unionFlg'		=>	'0',									//是否开通云闪付
			//'XY1'			=>	'',										//支付协议
			'CDJJ1'			=>	$this->data->pic_jj,					//场地街景
			'CDNJ1'			=>	$this->data->pic_nj,					//场地内景
			'ZZ1'			=>	$this->data->pic_zz, 					//三证合一或营业执照
		);

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
		$data['orgNumber']	=	config('aggregate.orgNumber');
		$data['agentNumber']=	config('aggregate.orgNumber');
		$data['seqNo']		=	$this->data->order_no;
		$data['mercMbl']	=	$this->data->mobile;
		$data['mercCnm']	=	$this->data->merchant_name;
		$data['mercAbbr']	=	$this->data->merchant_name_attr;
		$data['mccCd']		=	$this->data->merchant_mcc;
		$data['mercProv']	=	$this->data->merchant_prop;
		$data['mercCity']	=	$this->data->merchant_city;
		$data['mercCounty']	=	$this->data->merchant_county;
		$data['busAddr']	=	$this->data->merchant_address;

		$data['crpIdNo']	=	$this->data->card_no;
		$data['crpExpDtD']	=	$this->data->card_expd;
		$data['stlWcLbnkNo']=	$this->data->bank_link;
		$data['stlOac']		=	$this->data->bank_no;
		$data['bnkAcnm']	=	$this->data->bank_name;

		$data['debitFee']		=	(string)($this->data->debit_fee / 10000);
		$data['debitFeeLimit']	=	(string)$this->data->debit_fee_limit / 100;
		$data['creditFee']		=	(string)($this->data->credit_fee / 10000);
		$data['d0Fee']			=	(string)($this->data->d0_fee / 10000);
		$data['d0FeeQuota']		=	(string)$this->data->d0_fee_quota / 100;
		$data['unionCreditFee']	=	(string)($this->data->union_credit_fee / 10000);
		$data['unionDebitFee']	=	(string)($this->data->union_debit_fee / 10000);
		$data['aliFee']			=	(string)($this->data->ali_fee / 10000);
		$data['wxFee']			=	(string)($this->data->wx_fee / 10000);

		$data['outMercId']		=	$this->data->out_mercid;
		$data['settType']		=	'T1';

		$data['SFZ1']			=	$this->data->pic_sfz1;
		$data['SFZ2']			=	$this->data->pic_sfz2;
		$data['YHK']			=	$this->data->pic_yhk;
		$data['CDMT1']			=	$this->data->pic_mt;

		/**
		 * 进件参数加密
		 */
		$data['sign'] = $this->netInSign($data);

		$arrs = array();

		foreach ($data as $key => $value) {
			$arrs[] = array('name' => $key, 'contents' => in_array($key, ['SFZ1', 'SFZ2', 'YHK', 'CDMT1', 'ZZ1', 'CDJJ1', 'CDNJ1']) ? fopen(\App\Server\OSS::getPrivateObjectURLWithExpireTime($value, new DateTime('+1 day')), 'r') : $value);
		}

		$client     = new GuzzClient();

		$result 	= $client->request('POST', $this->url, [ 'multipart' => $arrs ]);

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
	public function netInSign($params)
	{
		foreach ($params as $key => $value) {
			if($value == "" && $value !== 0) unset($params[$key]);
			if(in_array($key, ['SFZ1', 'SFZ2', 'YHK', 'CDMT1', 'ZZ1', 'CDJJ1', 'CDNJ1'])) unset($params[$key]);
		}

		$private_key = file_get_contents(storage_path('app/public/rsa/net/rsa_private_key.pem'));

		ksort($params);

		$params = json_encode($params, JSON_UNESCAPED_UNICODE);

	   	$pi_key =  openssl_get_privatekey($private_key);
	   	
	   	openssl_sign($params, $binary_signature, $pi_key, OPENSSL_ALGO_MD5);
	   	
	   	openssl_free_key($pi_key);

	   	return base64_encode($binary_signature);
	}
}

