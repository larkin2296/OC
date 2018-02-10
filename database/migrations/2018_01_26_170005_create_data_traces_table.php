<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDataTracesTable.
 */
class CreateDataTracesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('data_traces', function(Blueprint $table) {
            $table->integer('company_id')->nullable()->default(0)->comment("公司id");
            $table->integer('report_id')->nullable()->default(0)->comment('报告id');
            $table->string('report_identify')->nullable()->default('')->comment('报告编号');
            $table->integer('report_tab_id')->nullable()->default(0)->comment('报告标签页');
            $table->string('field')->nullable()->default('')->comment('字段');
            $table->string('old_value')->nullable()->default('')->comment('字段旧值');
            $table->string('new_value')->nullable()->default('')->comment('字段新值');
            $table->string('action_status')->nullable()->default('')->comment('操作状态');
            $table->string('action_description')->nullable()->default('')->comment('操作说明');
            $table->integer('user_id')->nullable()->default(0)->comment('操作者id');
            $table->string('user_name')->nullable()->default('')->comment('操作者id');
            $table->string('user_role')->nullable()->default('')->comment('操作人角色');


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
		Schema::drop('data_traces');
	}
}
