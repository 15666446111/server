<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantTemialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_temials', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('merc_no')->comment('商户号');

            $table->string('sn')->comment('终端sn');

            $table->string('term_no')->comment('外部终端号 不超过8位。');

            $table->string('dy_term_no')->nullable()->comment('外部终端号 不超过8位。');

            $table->string('term_name')->comment('门店名称');

            $table->string('term_address')->comment('门店地址');

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
        Schema::dropIfExists('merchant_temials');
    }
}
