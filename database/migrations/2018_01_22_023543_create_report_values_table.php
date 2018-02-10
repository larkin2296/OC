<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportValuesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('report_values', function(Blueprint $table) {
			$table->increments('id');
			
			$table->integer('company_id')->nullable()->default(0)->comment('公司id');
            /*字段的报告信息*/
            $table->integer('report_id')->nullable()->default(0)->comment('报告id');
            $table->integer('report_tab_id')->nullable()->default(0)->comment('tab的id');
            /*tab的列信息*/
            $table->integer('col')->nullable()->default(0)->comment('tab的列id');
            $table->string('col_name')->nullable()->default(0)->comment('tab的列名称');

            /*字段基本信息*/
            $table->string('name')->nullable()->default('')->comment('数据点名称');
            $table->string('description')->nullable()->default('')->comment('数据点描述');
            $table->string('value')->nullable()->default('')->comment('数据点的值');

            /*字段的表格专有属性*/
            $table->tinyInteger('is_table')->nullable()->default(0)->comment("是否是表格");
            $table->string('table_alias')->nullable()->default('')->comment('表格id');
            $table->tinyInteger('table_row_id')->nullable()->default(0)->comment('表格行号');
            /*软删除*/
            $table->softDeletes();
            
            $table->timestamps();

            $table->unique(['company_id', 'report_id', 'report_tab_id', 'name', 'table_row_id', 'col', 'deleted_at'], 'unique_report_name_table_col');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('report_values');
	}

}
