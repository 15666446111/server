<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points_orders', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('order_no')->comment('订单号');

            $table->bigInteger('product_id')->comment('积分产品');

            $table->string('order_pic')->nullable()->comment('截图');

            $table->smallInteger('status')->default(0)->comment('订单状态');

            $table->integer('order_money')->default(0)->comment('订单金额');

            $table->integer('pay_money')->default(0)->comment('发放金额');

            $table->timestamp('verfity_time')->nullable()->comment('审核时间');

            $table->string('order_remark')->nullable()->comment('订单备注');

            $table->string('notify_url')->nullable()->comment('通知地址');

            $table->text('notify_answ')->nullable()->comment('通知应答');

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
        Schema::dropIfExists('points_orders');
    }
}
