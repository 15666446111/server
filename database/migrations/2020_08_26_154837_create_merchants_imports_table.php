<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants_imports', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('order_no')->comment('请求订单号');

            $table->string('mobile')->comment('商户手机号');

            $table->string('merchant_name')->comment('商户名称');

            $table->string('merchant_name_attr')->comment('商户简称');

            $table->string('merchant_mcc')->comment('MCC码');

            $table->string('merchant_prop')->comment('归属省');

            $table->string('merchant_city')->comment('归属市');

            $table->string('merchant_county')->comment('归属区县');

            $table->string('merchant_address')->comment('归属地址');

            $table->string('merchant_tel')->nullable()->comment('座机电话');

            $table->string('reg_no')->nullable()->comment('营业执照号');

            $table->string('reg_expd')->nullable()->comment('营业执照过期时间');

            $table->string('card_no')->comment('法人身份证号');

            $table->string('card_name')->nullable()->comment('法人姓名');

            $table->string('card_expd')->nullable()->comment('证件过期时间');

            $table->string('bank_link')->nullable()->comment('联行号');

            $table->string('bank_no')->nullable()->comment('银行账号');

            $table->string('bank_name')->nullable()->comment('银行开户名称');

            $table->string('user_email')->nullable()->comment('商户管理员EMAIL');

            $table->smallInteger('debit_fee')->defaule(0)->comment('借记费率');

            $table->smallInteger('debit_fee_limit')->defaule(0)->comment('借记封顶额');

            $table->smallInteger('credit_fee')->defaule(0)->comment('贷记费率');

            $table->smallInteger('d0_fee')->defaule(0)->comment('D0额外手续费费率');

            $table->smallInteger('d0_fee_quota')->defaule(0)->comment('D0额外定额手续费');

            $table->smallInteger('union_credit_fee')->defaule(0)->comment('云闪付贷记费率');

            $table->smallInteger('union_debit_fee')->defaule(0)->comment('云闪付借记费率');

            $table->smallInteger('ali_fee')->defaule(0)->comment('支付宝费率');

            $table->smallInteger('wx_fee')->defaule(0)->comment('微信费率');

            $table->string('out_mercid')->nullable()->comment('机构方商户标识');

            $table->string('sett_type')->nullable()->comment('结算类型');

            $table->string('pic_xy')->nullable()->comment('支付协议');

            $table->string('pic_zz')->nullable()->comment('三证合一或营业执照');

            $table->string('pic_yhk')->nullable()->comment('银行卡');

            $table->string('pic_sfz1')->nullable()->comment('身份证正面');

            $table->string('pic_sfz2')->nullable()->comment('身份证反面');

            $table->string('pic_jj')->nullable()->comment('场地街景');

            $table->string('pic_mt')->nullable()->comment('场地门头');

            $table->string('pic_nj')->nullable()->comment('场地内景');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchants_imports');
    }
}
