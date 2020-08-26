<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFilesToPointsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('points_orders', function (Blueprint $table) {

            $table->string('content')->nullable()->comment('兑换码')->after('order_pic');
            
            $table->string('ident')->nullable()->comment('会员标识')->after('notify_answ');

            $table->string('merchant')->nullable()->comment('所属平台')->after('ident');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('points_orders', function (Blueprint $table) {
            //
        });
    }
}
