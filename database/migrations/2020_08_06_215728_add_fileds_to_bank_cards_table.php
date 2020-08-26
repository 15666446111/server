<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFiledsToBankCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_cards', function (Blueprint $table) {

            $table->string('icon')->nullable()->comment('银行ICON图标')->after('title');


            $table->string('ligheight')->nullable()->comment('亮点')->after('status');
            
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
