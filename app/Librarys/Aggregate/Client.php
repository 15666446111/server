<?php

namespace App\Librarys\Aggregate;

use GuzzleHttp\Client as GuzzClient;

class Client
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
	public function netIn()
	{

		$url = 'http://116.228.47.74:18480/merchant_agent_foreign'.'/rest/microMerchant/inComing';

		$orderNo = "A".time();

		file_put_contents("./a.text", $orderNo);

		$bodyData = array(
			'orgNumber'		=>	'999',
			'agentNumber'	=>	'999',
			'seqNo'			=>	$orderNo,
			'mercMbl'		=>	'15666446111', //商户手机号
			'mercCnm'		=>	'巩克', //商户名称
			'mercAbbr'		=>	'个体商户巩克', 	//商户简称
			'mccCd'			=>	'5732', //MCC 码,
			'mercProv'		=>	'4500', //归属省
			'mercCity'		=>	'4510', //归属市
			'mercCounty'	=>	'4519', //归属县区
			'busAddr'		=>	'银座好望角1202', //营业地址
			'crpIdNo'		=>	'372321199308194919', //法人证件号码
			'crpExpDtD'		=>	'2028-06-08', //法人证件过期日期
			'stlWcLbnkNo'	=>	'102451015037', //联行行号 对私非必填
			'stlOac'		=>	'6212261602008600316', //银行账号,
			'bnkAcnm'		=>	'巩克', //银行开户名称
			'debitFee'		=>	'0.0038', 	//借记费率 格式:千三表示为 0.003
			'debitFeeLimit'	=>	'5.25', 	//借记封顶额 单位:元;包括小数位
			'creditFee'		=>	'0.0042', 	//贷记费率 格式:千三表示为 0.003
			'd0Fee'			=>	"0", //D0 额外手续费费率 若无填 0
			'd0FeeQuota'	=>	"0", //D0 额外定额手续费 若无填 0
			'unionCreditFee'=>	'0.0042', //云闪付贷记费率 格式:千三表示为 0.003
			'unionDebitFee'	=>	'0.0038', //云闪付借记费率
			'aliFee'		=>	'0.0042', //支付宝费率
			'wxFee'			=>	'0.0042', //微信费率
			'outMercId'		=>	$this->merchant, // 机构方商户标识 Id)不超 过20位
			'settType'		=>	'T1',
			'SFZ1'			=>	storage_path('app/public/uploads/images/588e7d5addf3f54a43e74270dbc15838.jpg'),
			'SFZ2'			=>	storage_path('app/public/uploads/images/588e7d5addf3f54a43e74270dbc15838.jpg'),
			'YHK'			=>	storage_path('app/public/uploads/images/588e7d5addf3f54a43e74270dbc15838.jpg'),
			'CDMT1'			=>	storage_path('app/public/uploads/images/588e7d5addf3f54a43e74270dbc15838.jpg'),
		);

		$this->send($url, $bodyData);
	}



	/**
	 * @Author    Pudding
	 * @DateTime  2020-08-25
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ 标准商户进件 ]
	 * @return    [type]      [description]
	 */
	public function bzNetIn()
	{
		$url = 'http://116.228.47.74:18480/merchant_agent_foreign'.'/rest/standardMerchant/inComing';

		$orderNo = "A".time();

		$bodyData = array(
			'orgNumber'		=>	'999',
			'agentNumber'	=>	'999',
			'seqNo'			=>	$orderNo,
			'mercMbl'		=>	'15562685678', 							//商户手机号
			'mercCnm'		=>	'山东柒拾贰茗泉茶文化有限公司', 				//商户名称
			'mercAbbr'		=>	'柒拾贰茗泉茶文化有限公司', 					//商户简称
			'mercHotLin'	=>	'053186111111',							//座机电话
			'mccCd'			=>	'5813', 								//MCC码,
			'mercProv'		=>	'4500', 								//归属省
			'mercCity'		=>	'4510', 								//归属市
			'mercCounty'	=>	'4516', 								//归属县区
			'busAddr'		=>	'山东省济南市高新区综合保税区空港功能区综合楼三层301室', 	//营业地址
			'mercAttr'		=>	'9',									//商户性质  1-标准商户(个体)  9-其他(企业)
			'regId'			=>	'91370100MA3TRPND7A',					//营业执照号
			'regExpDtD'		=>	'2040-08-19',							// 营业执照过期时间
			'crpIdTyp'		=>	'0',									// 法人证件类型 0-身份证
			'crpIdNo'		=>	'360424196407166742', 					//法人证件号码
			'crpNm'			=>	'叶玲道',									//法人姓名
			'crpExpDtD'		=>	'2029-03-19', 							//法人证件过期日期
			'stlSign'		=>	'1',									//结算账号公私标志 0-对公 1-对私(法人) 2-暂不结算

			'stlWcLbnkNo'	=>	'103451012615', 						//联行行号 对私非必填
			'stlOac'		=>	'6228460250002592512', 					//银行账号,
			'bnkAcnm'		=>	'叶玲道', 								//银行开户名称
			'usrOprEmail'	=>	'755969423@qq.com',						//商户管理员 EMAIL


			'entAccBnkNm'	=>	'123',										//企账户银行名称 商户性质为其他且结算账号 公私标志为对私或暂不结算-必 传
			'entAccNm'		=>	'123',										//企业账户名称 商户性质为其他且结算账号 公私标志为对私或暂不结算-必 传
			'entAccNo'		=>	'123',										//企业账号 商户性质为其他且结算账号 公私标志为对私或暂不结算-必 传


			'debitFee'		=>	'0.0035', 								//借记费率 格式:千三表示为 0.003
			'debitFeeLimit'	=>	'5.20', 								//借记封顶额 单位:元;包括小数位
			'creditFee'		=>	'0.0035', 								//贷记费率 格式:千三表示为 0.003
			'd0Fee'			=>	"0", 									//D0 额外手续费费率 若无填 0
			'd0FeeQuota'	=>	"0", 									//D0 额外定额手续费 若无填 0
			'unionCreditFee'=>	'0.0035', 								//云闪付贷记费率 格式:千三表示为 0.003
			'unionDebitFee'	=>	'0.0035', 								//云闪付借记费率
			'aliFee'		=>	'0.0035', 								//支付宝费率
			'wxFee'			=>	'0.0035', 								//微信费率
			'aliFlg'		=>	'0',									//是否开通支付宝
			'wxFlg'			=>	'0',									//是否开通微信
			'unionFlg'		=>	'0',									//是否开通云闪付
			'outMercId'		=>	$this->merchant, 						// 机构方商户标识 Id)不超 过20位
			'settType'		=>	'T1',									//结算类型
			//'XY1'			=>	'',										//支付协议
			'ZZ1'			=>	storage_path('app/public/uploads/images/zz1.jpeg'),//三证合一或营业执照
			'YHK'			=>	storage_path('app/public/uploads/images/yhk.jpeg'),//银行卡
			'SFZ1'			=>	storage_path('app/public/uploads/images/sfz1.jpeg'),
			'SFZ2'			=>	storage_path('app/public/uploads/images/sfz2.jpeg'),
			'CDJJ1'			=>	storage_path('app/public/uploads/images/cdcj1.jpeg'),	//场地街景
			'CDMT1'			=>	storage_path('app/public/uploads/images/cdcj1.jpeg'),   //场地门头
			'CDNJ1'			=>	storage_path('app/public/uploads/images/cdnj1.jpeg'),	//场地内景
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
		$data['sign'] = $this->netInSign($data);

		echo json_encode($data);

		$arrs = array();

		foreach ($data as $key => $value) {
			$arrs[] = array('name' => $key, 'contents' => in_array($key, ['SFZ1', 'SFZ2', 'YHK', 'CDMT1', 'ZZ1', 'CDJJ1', 'CDNJ1']) ? fopen($value, 'r') : $value);
		}

		

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
	public function netInSign($params)
	{
		foreach ($params as $key => $value) {
			if($value == "" && $value !== 0) unset($params[$key]);
			if(in_array($key, ['SFZ1', 'SFZ2', 'YHK', 'CDMT1', 'ZZ1', 'CDJJ1', 'CDNJ1'])) unset($params[$key]);
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

