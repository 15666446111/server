<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFilesToMerchantsImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchants_imports', function (Blueprint $table) {
            
            $table->smallInteger('status')->default(1)->comment('商户状态 1开启 0关闭');

            $table->smallInteger('sett_state')->default(1)->comment('结算状态 1开启 0关闭');

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
