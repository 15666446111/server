<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_settings', function (Blueprint $table) {


            $table->bigIncrements('id');
            
            $table->string('company')->nullable()->comment('公司名称');

            $table->string('people')->nullable()->comment('企业法人');

            $table->string('phone')->nullable()->comment('联系电话');

            $table->string('email')->nullable()->comment('公司邮箱');

            $table->string('address')->nullable()->comment('公司地址');


            $table->string('merchant_number')->comment('商户编号');

            $table->string('merchant_secret')->comment('商户密钥');

            $table->string('merchant_ability')->comment('商户能力');


            $table->string('apply_card_notify_url')->comment('申请卡片通知地址');

            $table->string('points_change_notify_url')->comment('积分兑换通知地址');

            $table->string('nocard_pay_notify_url')->comment('无卡支付通知地址');


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
        Schema::dropIfExists('merchant_settings');
    }
}
