<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question_num')->nullable()->comment('质疑编号');
            $table->string('report_num')->nullable()->comment('报告编号');
            $table->string('operation_name')->nullable()->comment('操作人');
            $table->tinyInteger('operation_id')->nullable()->comment('操作人id');
            $table->string('status')->nullable()->comment('状态');
            $table->string('operation_data')->nullable()->comment('操作日期');
            $table->text('content')->nullable()->comment('内容');
            $table->string('end_data')->nullable()->comment('截止日期');
            $table->string('sending')->nullable()->comment('发送次数');
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
        Schema::dropIfExists('question');
    }
}
