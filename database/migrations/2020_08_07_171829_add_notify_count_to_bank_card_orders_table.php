<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotifyCountToBankCardOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_card_orders', function (Blueprint $table) {
            $table->smallInteger('nofity_count')->default(0)->comment('通知次数')->after('notify_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bank_card_orders', function (Blueprint $table) {
            //
        });
    }
}
