<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;

use App\Http\Requests\MerchantBindRequest;
use App\Http\Requests\MerchantQueryRequest;
use App\Http\Requests\MerchantImportRequest;

class ApiJuHeController extends Controller
{


	/**
	 * @Author    Pudding
	 * @DateTime  2020-08-31
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [ 商户进件 - 微服务 ]
	 * @param     Request     $request [description]
	 * @return    [type]               [description]
	 */
    public function merchantImport(MerchantImportRequest $request)
    {

    	### 参数齐全 前去验签

    	### 接收上传的文件  资质照片 三证合一或者营业执照
    	if($request->hasFile('pic_zz') && $request->file('pic_zz')->isValid()){
    		//文件扩展名
            $zzFile = sha1($request->file('pic_zz')->getClientOriginalName().time().rand(100,999)).'.'.$request->file('pic_zz')->getClientOriginalExtension();
            Storage::disk('pay')->put($zzFile, file_get_contents($request->file('pic_zz')->path()));
            $zzPath   = 'pay/'. date('Ymd') . "/". $zzFile;
    	}

    	if($request->hasFile('pic_yhk') && $request->file('pic_yhk')->isValid()){
    		//文件扩展名
            $yhkFile = sha1($request->file('pic_yhk')->getClientOriginalName().time().rand(100,999)).'.'.$request->file('pic_yhk')->getClientOriginalExtension();
            Storage::disk('pay')->put($yhkFile, file_get_contents($request->file('pic_yhk')->path()));
            $yhkPath   = 'pay/'. date('Ymd') . "/". $yhkFile;
    	}

    	if($request->hasFile('pic_sfz1') && $request->file('pic_sfz1')->isValid()){
    		//文件扩展名
            $sfz1file = sha1($request->file('pic_sfz1')->getClientOriginalName().time().rand(100,999)).'.'.$request->file('pic_sfz1')->getClientOriginalExtension();
            Storage::disk('pay')->put($sfz1file, file_get_contents($request->file('pic_sfz1')->path()));
            $sfz1Path   = 'pay/'. date('Ymd') . "/". $sfz1file;
    	}

    	if($request->hasFile('pic_sfz2') && $request->file('pic_sfz2')->isValid()){
    		//文件扩展名
            $sfz2file = sha1($request->file('pic_sfz2')->getClientOriginalName().time().rand(100,999)).'.'.$request->file('pic_sfz2')->getClientOriginalExtension();
            Storage::disk('pay')->put($sfz2file, file_get_contents($request->file('pic_sfz2')->path()));
            $sfz2Path   = 'pay/'. date('Ymd') . "/". $sfz2file;
    	}

    	if($request->hasFile('pic_mt') && $request->file('pic_mt')->isValid()){
    		//文件扩展名
            $mtfile = sha1($request->file('pic_mt')->getClientOriginalName().time().rand(100,999)).'.'.$request->file('pic_mt')->getClientOriginalExtension();
            Storage::disk('pay')->put($mtfile, file_get_contents($request->file('pic_mt')->path()));
            $mtPath   = 'pay/'. date('Ymd') . "/". $mtfile;
    	}


    	if($request->hasFile('pic_jj') && $request->file('pic_jj')->isValid()){
    		//文件扩展名
            $jjfile = sha1($request->file('pic_jj')->getClientOriginalName().time().rand(100,999)).'.'.$request->file('pic_jj')->getClientOriginalExtension();
            Storage::disk('pay')->put($jjfile, file_get_contents($request->file('pic_jj')->path()));
            $jjPath   = 'pay/'. date('Ymd') . "/". $jjfile;
    	}

    	if($request->hasFile('pic_nj') && $request->file('pic_nj')->isValid()){
    		//文件扩展名
            $njfile = sha1($request->file('pic_nj')->getClientOriginalName().time().rand(100,999)).'.'.$request->file('pic_nj')->getClientOriginalExtension();
            Storage::disk('pay')->put($njfile, file_get_contents($request->file('pic_nj')->path()));
            $njPath   = 'pay/'. date('Ymd') . "/". $njfile;
    	}

    	if($request->hasFile('pic_xy') && $request->file('pic_xy')->isValid()){
    		//文件扩展名
            $xyfile = sha1($request->file('pic_xy')->getClientOriginalName().time().rand(100,999)).'.'.$request->file('pic_xy')->getClientOriginalExtension();
            Storage::disk('pay')->put($pic_xy, file_get_contents($request->file('pic_xy')->path()));
            $xyPath   = 'pay/'. date('Ymd') . "/". $xyfile;
    	}

    	### 写入数据库
    	$imports = \App\MerchantsImport::create([
    		'order_no'			=>	'CHB'.time().rand(1000,9999),//	生成请求订单号
    		'no'				=>	$request->no,						//	下游订单号
    		'mobile'			=>	$request->mobile,					//  商户手机号
    		'merchant_name'		=>	$request->merchant_name, 			// 	商户名称
    		'type'				=>	$request->type,						//  类型 标准 or 小微
    		'merchant_name_attr'=>	$request->merchant_name_attr, 		// 	商户简称,
    		'merchant_mcc'		=>	$request->merchant_mcc,				//  商户MCC码
    		'merchant_prop'		=>	$request->merchant_prop, 			// 	归属省,
    		'merchant_city'		=>	$request->merchant_city, 			// 	归属城市
    		'merchant_county'	=>	$request->merchant_county, 			// 	归属区县
    		'merchant_address'	=>	$request->merchant_address, 		// 	详细地址

    		'merchant_tel'		=>	$request->merchant_tel ?? '', 		// 座机电话
    		'reg_no'			=>	$request->reg_no ?? '',				// 营业执照编号
    		'reg_expd'			=>	$request->reg_expd ?? '',			// 营业执照过期时间

    		'card_no'			=>	$request->card_no,			// 法人身份证号
    		'card_name'			=>	$request->card_name,		// 法人姓名
    		'card_expd'			=>	$request->card_expd,		// 证件过期时间

    		'bank_link'			=>	$request->bank_link,		// 联航号
    		'bank_no'			=>	$request->bank_no,			// 银行账号
    		'bank_name'			=>	$request->bank_name,		// 银行开户名称

    		'debit_fee'			=>	$request->debit_fee,		// 借记卡废率
    		'debit_fee_limit'	=>	$request->debit_fee_limit,  // 借记卡封顶
    		'credit_fee'		=>	$request->credit_fee,		// 贷记卡费率
    		'd0_fee'			=>	$request->d0_fee,			// D0 额外手续费 费率
    		'd0_fee_quota'		=>	$request->d0_fee_quota,		// D0 额外手续费 定额
    		'union_credit_fee'	=>	$request->union_credit_fee,	// 云闪付贷记卡费率
    		'union_debit_fee'	=>	$request->union_debit_fee,  // 云闪付借记卡费率
    		'ali_fee'			=>	$request->ali_fee,			// 支付宝费率
    		'wx_fee'			=>	$request->wx_fee,			// 微信费率

    		'out_mercid'		=>	$request->out_mercid,		// 机构方商户标识
    		'sett_type'			=>	$request->sett_type,		// 结算类型


    		'pic_xy'			=>	$xyPath ?? '',				// 支付协议,
    		'pic_zz'			=>	$zzPath ?? '',				// 三证合一 或营业执照
    		'pic_yhk'			=>	$yhkPath ?? '',				// 银行卡照片
    		'pic_sfz1'			=>	$sfz1Path ?? '',			// 身份证照片 人像面
    		'pic_sfz2'			=>	$sfz2Path ?? '',			// 身份证照片 国徽面
    		'pic_mt'			=>	$mtPath ?? '',				// 场地门头照片
    		'pic_jj'			=>	$jjPath ?? '',				// 场地街景照片
    		'pic_nj'			=>	$njPath ?? '',				// 场地内景照片
    	]);

    	// 实力化 请求类
    	$applation = new \App\Librarys\Aggregate\Client($imports);	

    	$result    = $applation->run();


    }


    /**
     * @Author    Pudding
     * @DateTime  2020-09-01
     * @copyright [copyright]
     * @license   [license]
     * @version   [ 商户进件 - 修改商户信息 - 微服务 ]
     * @return    [type]      [description]
     */
    public function merchantUpdate(/*MerchantUpdateRequest $request*/)
    {

    }


    /**
     * @Author    Pudding
     * @DateTime  2020-09-01
     * @copyright [copyright]
     * @license   [license]
     * @version   [ 商户进件 - 查询商户信息 - 微服务 ]
     * @param     MerchantQueryRequest $request [description]
     * @return    [type]                        [description]
     */
    public function merchantQuery(MerchantQueryRequest $request)
    {
        $info = \App\MerchantsImport::where('merchant_number', $request->merchant_number)->first();

        // 实力化 请求类
        $applation = new \App\Librarys\Aggregate\Query($info);  

        $result    = $applation->query();
    }



    /**
     * @Author    Pudding
     * @DateTime  2020-09-03
     * @copyright [copyright]
     * @license   [license]
     * @version   [ 商户绑定机器 ]
     * @return    [type]      [description]
     */
    public function merchantBind(MerchantBindRequest $request)
    {
        $info = \App\MerchantsImport::where('merchant_number', $request->merchant_number)->first();

        // 实力化 请求类
        $applation = new \App\Librarys\Aggregate\Temial($info);  

        $result    = $applation->bind();
    }
}
