<?php

namespace App\Http\Requests;

/**
 * 聚合支付 商户绑定终端验证
 */
class MerchantBindRequest extends BaseRequests
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
            'merchant_sn'                  =>  'required|unique:merchant_temials,sn',                      //  外部sn号 不超过20位
            'merchant_term_no'             =>  'required|unique:merchant_temials,term_no',                 //  外部终端号 不超过20位
            'merchant_name'                =>  'required',                                                 //  终端名称
            'merchant_address'             =>  'required',                                                 //  终端地址
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
