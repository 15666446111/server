<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_cards', function (Blueprint $table) {
            
            $table->bigIncrements('id');

            $table->string('title')->comment('标题');

            $table->string('card_images')->nullable()->comment('图片');

            $table->integer('money')->default(0)->comment('奖励金额');

            $table->smallInteger('pip')->default(1)->comment('标准： 1下卡， 2下卡并首刷 3其他');

            $table->smallInteger('status')->default(1)->comment('状态');

            $table->string('apply_url')->nullable()->comment('申请地址');

            $table->text('content')->nullable()->comment('内容');

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
        Schema::dropIfExists('bank_cards');
    }
}
