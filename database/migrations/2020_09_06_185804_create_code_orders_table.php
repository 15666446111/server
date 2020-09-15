<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_orders', function (Blueprint $table) {
            
            $table->bigIncrements('id');

            $table->string('order_no')->comment('订单号');

            $table->string('no')->comment('下游订单号');

            $table->string('dy_no')->nullable()->comment('电银订单号');

            $table->string('out_mercid')->comment('机构方');

            $table->string('merchant_number')->nullable()->comment('商户号');

            $table->string('term_no')->nullable()->comment('终端号');

            $table->integer('money')->default(0)->comment('交易金额');

            $table->string('type')->default('P03')->comment('交易方式');

            $table->string('code_url')->nullable()->comment('二维码地址');

            $table->string('call_url')->comment('通知地址');

            $table->smallInteger('state')->default(0)->comment('交易状态');

            $table->smallInteger('call_count')->default(1)->comment('回调次数');

            $table->string('call_answer')->nullable()->comment('回调内容');

            $table->text('dy_return')->nullable()->comment('电银返回');

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
        Schema::dropIfExists('code_orders');
    }
}
