<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateReportTasksTable.
 */
class CreateReportTasksTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('report_tasks', function(Blueprint $table) {
            $table->increments('id');

            $table->integer('company_id')->nullable()->default(0)->comment('公司id');

            $table->integer('report_id')->nullable()->default(0)->comment('报告id');
            $table->string('report_identify')->nullable()->default('')->comment('报告编号');
            $table->timestamp('report_first_received_date')->nullable()->comment('获知时间');
            $table->timestamp('assigned_at')->nullable()->comment('报告分发时间');
            $table->string('drug_name')->nullable()->default('')->comment('药物名称');
            $table->string('first_drug_name')->nullable()->default('')->comment('首要药物名称');
            $table->string('event_term')->nullable()->default('')->comment('不良事件');
            $table->string('first_event_term')->nullable()->default('')->comment('首要不良事件');
            $table->string('seriousness')->nullable()->default('')->comment('严重性');
            $table->string('standard_of_seriousness')->nullable()->default('')->comment('严重性标准');
            $table->string('case_causality')->nullable()->default('')->comment('因果关系');
            $table->string('report_cate')->nullable()->default('')->comment('报告分类，首次报告，随访报告');
            $table->integer('task_user_id')->nullable()->default(0)->comment('处理人id');
            $table->string('task_user_name')->nullable()->default('')->comment('处理人姓名');
            $table->integer('organize_role_id')->nullable()->default(0)->comment('任务进度，组织角色id,当前任务id');
            $table->string('organize_role_name')->nullable()->default('')->comment('任务进度，组织角色名称');
            $table->string('received_from_id')->nullable()->default('')->comment('企业报告类型');
            $table->tinyInteger('status')->nullable()->default(2)->comment('1-已完成， 2-未完成');
            $table->integer('source_id')->nullable()->default(0)->comment('资料id');
            $table->timestamp('task_countdown')->nullable()->comment('任务倒计时,分发时间+各个任务的倒计时');
            $table->timestamp('report_countdown')->nullable()->comment('报告倒计时，获悉时间+报告完成倒计时');
            $table->integer('regulation_id')->nullable()->default(0)->comment('报告规则id');
            $table->integer('data_insert_countdown')->nullable()->default(0)->comment('数据录入倒计时');
            $table->integer('data_qc_countdown')->nullable()->default(0)->comment('数据质控QC倒计时');
            $table->integer('medical_exam_countdown')->nullable()->default(0)->comment('医学审评倒计时');
            $table->integer('medical_exam_qc_countdown')->nullable()->default(0)->comment('医学审评QC倒计时');
            $table->integer('report_submit_countdown')->nullable()->default(0)->comment('报告递交倒计时');
            $table->integer('report_complete_countdown')->nullable()->default(0)->comment('报告完成倒计时');
            $table->string('countdown_unit', 2)->nullable()->default('')->comment('倒计时单位');

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
		Schema::drop('report_tasks');
	}
}
