<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRecommandToPointProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('point_products', function (Blueprint $table) {
            
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
        Schema::table('point_products', function (Blueprint $table) {
            //
        });
    }
}
