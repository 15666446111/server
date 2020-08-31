<?php

namespace App\Http\Requests;

/**
 * 聚合支付 商户进件类验证 
 */
class MerchantImportRequest extends BaseRequests
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            /**
             * @version  必填项  [<description>]
             */
            'no'                =>  'required|digits_between:8,30|unique:merchants_imports,no',     //  下游订单号
            'type'              =>  'required|in:1,2',                                              //  商户类型 必须为 1 2中的其中一个
            
            // 商户设置 
            'mobile'            =>  'required|digits_between:11,11',                                //  商户手机号 必填
            'merchant_name'     =>  'required|between:4,30',                                        //  商户名称
            'merchant_name_attr'=>  'required|between:4,30',                                        //  商户简称
            'merchant_mcc'      =>  'required',                                                     //  商户MCC
            'merchant_prop'     =>  'required',                                                     //  归属省
            'merchant_city'     =>  'required',                                                     //  归属市
            'merchant_county'   =>  'required',                                                     //  归属区县
            'merchant_address'  =>  'required',                                                     //  详细地址
                
            // 证件信息
            'card_no'           =>  'required',                                                     //  法人身份证号
            'card_expd'         =>  'required',                                                     //  法人证件过期时间

            // 银行设置
            'bank_link'         =>  'required',                                                     //  联行号
            'bank_no'           =>  'required',                                                     //  银行账户
            'bank_name'         =>  'required',                                                     //  银行开户名称

            // 费率设置 
            'debit_fee'         =>  'required|integer',                                             //  借记卡费率
            'debit_fee_limit'   =>  'required',                                                     //  借记卡封顶
            'credit_fee'        =>  'required|integer',                                            //   贷记卡费率
            'd0_fee'            =>  'required|integer',                                             //  D0 额外手续费 费率
            'd0_fee_quota'      =>  'required',                                                     //  D0 额外手续费 定额
            'union_credit_fee'  =>  'required|integer',                                             //  云闪付贷记卡费率
            'union_debit_fee'   =>  'required|integer',                                             //  云闪付借记卡费率
            'ali_fee'           =>  'required|integer',                                             //  支付宝费率
            'wx_fee'            =>  'required|integer',                                             //  微信费率

            // 照片信息
            'pic_yhk'           =>  'required|mimes:jpeg,png,jpg',                                  //  银行卡照片
            'pic_sfz1'          =>  'required|mimes:jpeg,png,jpg',                                  //  身份证人像面
            'pic_sfz2'          =>  'required|mimes:jpeg,png,jpg',                                  //  身份证国徽面
            'pic_mt'            =>  'required|mimes:jpeg,png,jpg',                                  //  门头照

            // 进件类型为标准商户进件时。
            'pic_jj'            =>  'required_if:type,1|mimes:jpeg,png,jpg',                        //  标准商户进件 必填
            'pic_nj'            =>  'required_if:type,1|mimes:jpeg,png,jpg',                        //  标准商户进件 必填
            'reg_no'            =>  'required_if:type,1|string|alpha_num',                          //  标准商户进件 营业执照编号 必填
            'reg_expd'          =>  'required_if:type,1',                                           //  标准商户进件 营业执照过期时间
            'card_name'         =>  'required_if:type,1',                                           //  标准商户进件 法人姓名
            'merchant_tel'      =>  'required_if:type,1',                                           //  标准商户进件 座机电话
        ];
    }

    /**
     * 获取已定义验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'account.required'      =>  '请输入您的账号',
            'account.exists'        =>  '账号不存在',
            'password.required'     =>  '请输入您的密码',
            'password.min'          =>  '密码最小为6位',
            'password.max'          =>  '密码最大为16位',
        ];
    }



}
