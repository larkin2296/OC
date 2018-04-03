<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_of_card_supply')->nullable()->comment('供卡名称');
            $table->string('supply_status')->nullable()->comment('供卡状态');
            $table->string('denomination')->nullable()->comment('面额');
            $table->string('order_type')->nullable()->comment('订单类型');
            $table->string('supply_time')->nullable()->comment('供货时间');
            $table->string('order_time')->nullable()->comment('订单时间');
            $table->string('order_number')->nullable()->comment('订单号');
            $table->string('discount')->nullable()->comment('油卡折扣');
            $table->string('pin_denomination_card')->nullable()->comment('实际销卡面额');
            $table->string('content')->nullable()->comment('备注');
            $table->string('user_id')->nullable()->comment('用户id');
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
        Schema::dropIfExists('order');
    }
}
