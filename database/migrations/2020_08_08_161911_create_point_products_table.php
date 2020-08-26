<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_products', function (Blueprint $table) {
            
            $table->bigIncrements('id');

            $table->string('title')->comment('标题');

            $table->integer('card_id')->comment('归属银行');

            $table->integer('need_points')->comment('所需积分');

            $table->string('change_count')->comment('兑换次数');

            $table->smallInteger('change_type')->comment('兑换方式');

            $table->integer('product_money')->comment('产品价格');

            $table->string('demo')->nullable()->comment('示例图片');


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
        Schema::dropIfExists('point_products');
    }
}
