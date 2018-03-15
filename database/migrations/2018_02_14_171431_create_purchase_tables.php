<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase', function(Blueprint $table) {
            $table->increments('id');
            $table->string('purchase_number')->nullable()->comment('卡密');
            $table->string('denomination')->nullable()->comment('面额');
            $table->string('number')->nullable()->comment('数量');
            $table->string('commodity')->nullable()->comment('商品名称');
            $table->string('price')->nullable()->comment('价格');
            $table->string('total_price')->nullable()->comment('价格总计');
            $table->tinyInteger('status')->nullable()->default(1)->comment('1-正常，2-关闭');
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
        //
    }
}
