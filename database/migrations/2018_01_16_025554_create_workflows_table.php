<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('workflows', function(Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable()->default('')->comment('工作流名称');
            $table->integer('company_id')->nullable()->default(0)->comment('单位id');
            $table->string('company_name')->nullable()->default('')->comment('单位名称');

            $table->tinyInteger('status')->nullable()->default(2)->comment('1-有效,2-无效');
            $table->tinyInteger('is_use')->nullable()->default(2)->comment('1-使用，2-不使用');

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
		Schema::drop('workflows');
	}

}
