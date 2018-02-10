<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateReportTabsTable.
 */
class CreateReportTabsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('report_tabs', function(Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable()->default('')->comment('tab名称');

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
		Schema::drop('report_tabs');
	}
}
