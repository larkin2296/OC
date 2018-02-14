<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateManagementsTable.
 */
class CreateManagementsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('managements', function(Blueprint $table) {
            $table->increments('id');
            $table->string('oc_number')->nullable()->comment('油卡编号');
            $table->string('name')->nullable()->comment('真实姓名');
            $table->string('card_number')->nullable()->comment('油卡号');
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
		Schema::drop('managements');
	}
}
