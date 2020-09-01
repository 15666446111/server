<?php

namespace App\Http\Requests;

/**
 * 聚合支付 商户进件类验证 
 */
class MerchantQueryRequest extends BaseRequests
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
