<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFiledsToMerchantsImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchants_imports', function (Blueprint $table) {

            $table->string('no')->comment('下游订单号')->after('order_no');

            $table->string('dy_no')->comment('电银订单号')->after('id');

            $table->smallInteger('state')->default(0)->comment('状态')->after('pic_nj');

            $table->smallInteger('type')->default(1)->comment('类型: 1=标准 2=小微')->after('merchant_name');

            $table->string('merchant_nnumber')->nullable()->comment('商户号')->after('merchant_name_attr');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchants_imports', function (Blueprint $table) {
            //
        });
    }
}
