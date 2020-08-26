<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankCardOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_card_orders', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('order_no')->comment('订单编号');

            $table->bigInteger('card_id')->comment('银行/卡种');

            $table->string('name')->nullable()->comment('申请人');

            $table->string('phone')->nullable()->comment('手机号');

            $table->string('idcard')->nullable()->comment('身份证号');

            $table->string('order_title')->nullable()->comment('申请时标题');

            $table->integer('order_money')->default(0)->comment('申请时金额');

            $table->smallInteger('order_pip')->default(1)->comment('申请时条件');

            $table->string('order_pic')->nullable()->comment('申请时图片');

            $table->smallInteger('status')->default(0)->comment('状态');

            $table->integer('pay_money')->default(0)->comment('发放金额');

            $table->timestamp('verfity_time')->nullable()->comment('审核时间');

            $table->string('order_remark')->nullable()->comment('订单备注');

            $table->string('notify_url')->nullable()->comment('通知地址');

            $table->smallInteger('nofity_count')->default(0)->comment('通知次数');

            $table->text('notify_answ')->nullable()->comment('通知应答');

            $table->string('ident')->nullable()->comment('标识');

            $table->string('merchant')->nullable()->comment('商户');

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
        Schema::dropIfExists('bank_card_orders');
    }
}
