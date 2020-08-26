<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSortToBankCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_cards', function (Blueprint $table) {
            
            $table->integer('sort')->default(0)->comment('排序权重')->after('status');

            $table->smallInteger('recommand')->default(0)->comment('是否推荐')->after('sort');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bank_cards', function (Blueprint $table) {
            //
        });
    }
}
