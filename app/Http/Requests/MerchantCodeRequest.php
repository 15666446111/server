<?php

namespace App\Http\Requests;

/**
 * 聚合支付 商户绑定终端验证
 */
class MerchantCodeRequest extends BaseRequests
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
            'merchant_number'              =>  'required|exists:merchants_imports,merchant_number',        //  商户号 必须存在表
            'out_mercid'                   =>  'required|exists:merchant_settings,merchant_number',        //  外部机构方
            'term_no'                      =>  'required|exists:merchant_temials,dy_term_no',              //  电银的终端号
            'no'                           =>  'required|unique:code_orders,no',                           //  下游订单号
            'trancde'                      =>  'required|in:P03,P04,P05',     // 方式 P03 微信动态码 P04 云闪付二维码 P05 支付宝动态码
            'amount'                       =>  'required|integer',                                         // 金额: 分
            'notify_url'                   =>  'required|active_url'                                       // 有效的a或4a记录
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
            'merchant_number.required'      =>  '商户编号必须存在!',
        ];
    }



}
