<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportMainpageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_mainpage', function (Blueprint $table) {
            $table->increments('id');
            $table->string('report_first_received_date')->nullable()->comment('首次获悉的时间');
            $table->string('report_drug_safety_date')->nullable()->comment('pv获悉的时间');
            $table->tinyInteger('aecountry_id')->nullable()->comment('根据国家表id ');
            $table->tinyInteger('aecountrys_id')->nullable()->comment('事件发生国家父id');
            $table->tinyInteger('aecountry')->nullable()->comment('事件发生国家');
            $table->tinyInteger('received_fromid_id')->nullable()->comment('报告者类型id');
            $table->tinyInteger('received_fromids_id')->nullable()->comment('报告者类型父级id');
            $table->string('received_from_id')->nullable()->comment('报告类型');

            $table->string('research_id')->nullable()->comment('项目编号');
            $table->string('scheme_num')->nullable()->comment('方案编号');
            $table->string('center_number')->nullable()->comment('中心编号');
            $table->string('delayedreason')->nullable()->comment('迟报原因');
            $table->string('brand_name')->nullable()->comment('商品名称');
            $table->string('generic_name')->nullable()->comment('通用名称');
            $table->string('event_term')->nullable()->comment('不良事件');
            $table->tinyInteger('seriousness')->nullable()->default(1)->comment('是否严重0:是;1:否');
            $table->string('eventof_onset')->nullable()->comment('不良事件发生时间 格式：2018-1-30|未知-1-30');
//            /*患者信息*/
            $table->string('report_type')->nullable()->comment('报告类型');
            $table->string('reporter_organisation')->nullable()->comment('单位名称');
            $table->string('reporter_department')->nullable()->comment('部门名称');
            $table->string('reporter_country')->nullable()->comment('报告者国家');
            $table->tinyInteger('reporter_country_id')->nullable()->comment('报告者国家id');
            $table->tinyInteger('reporter_countries_id')->nullable()->comment('报告者国家父级id');
            $table->string('reporter_stateor_province')->nullable()->comment('省');
            $table->string('reporter_city')->nullable()->comment('市');
            $table->string('reporter_post')->nullable()->comment('邮编');
            $table->string('peporter_telephone_number')->nullable()->comment('报告者电话');

            $table->string('patient_name')->nullable()->comment('患者姓名');
            $table->string('subject_number')->nullable()->comment('患者编号');
            $table->string('date_of_birth')->nullable()->comment('出身年月日 格式:2018-1-30|未知-1-30');
            $table->tinyInteger('age')->nullable()->comment('年龄');
            $table->tinyInteger('age_at_timeofonsetunit')->nullable()->comment('单位年龄 0:日;1:月;2:岁');
            $table->tinyInteger('sex')->nullable()->comment('性别 0:女;1:男0;2:未知');
            $table->string('patient_contact_information')->nullable()->comment('电话');
            /*文献信息*/
            $table->string('literature_published_year')->nullable()->comment('文献id');
            $table->string('literature_author')->nullable()->comment('关键词');
            $table->string('literature_published_journals')->nullable()->comment('期刊名');
            $table->string('literature_title')->nullable()->comment('文献标题');
            /*展示*/
            $table->string('report_identifier')->nullable()->comment('报告编号');
            $table->string('status_type')->nullable()->comment('状态qc ...');

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
        Schema::dropIfExists('report_mainpage');
    }
}
