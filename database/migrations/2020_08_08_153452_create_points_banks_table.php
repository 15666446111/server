<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointsBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points_banks', function (Blueprint $table) {
            
            $table->bigIncrements('id');

            $table->string('title')->comment('标题');

            $table->string('icon')->nullable()->comment('银行ICON图标');

            $table->integer('money')->default(0)->comment('每1万积分/价值');

            $table->string('pip')->nullable()->comment('自助 / 客服介入');

            $table->integer('sort')->default(0)->comment('排序权重');

            $table->smallInteger('status')->default(1)->comment('状态');

            $table->smallInteger('recommand')->default(0)->comment('是否推荐');

            $table->string('ligheight')->nullable()->comment('亮点');

            $table->string('select_type')->nullable()->comment('查询方式');

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
        Schema::dropIfExists('points_banks');
    }
}
