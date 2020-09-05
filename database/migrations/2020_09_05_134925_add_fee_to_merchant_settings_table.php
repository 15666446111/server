<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeeToMerchantSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchant_settings', function (Blueprint $table) {
            
            $table->smallInteger('debit_fee')->default(0)->comment('借记卡费率');

            $table->smallInteger('debit_fee_limit')->default(0)->comment('借记卡封顶');

            $table->smallInteger('credit_fee')->default(0)->comment('贷记卡费率');

            $table->smallInteger('d0_fee')->default(0)->comment('D0额外手续费率');

            $table->smallInteger('d0_fee_quota')->default(0)->comment('D0额外定额手续费');

            $table->smallInteger('union_credit_fee')->default(0)->comment('云闪付贷记卡费率');

            $table->smallInteger('union_debit_fee')->default(0)->comment('云闪付借记卡费率');

            $table->smallInteger('ali_fee')->default(0)->comment('支付宝费率');

            $table->smallInteger('wx_fee')->default(0)->comment('微信费率');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchant_settings', function (Blueprint $table) {
            //
        });
    }
}
