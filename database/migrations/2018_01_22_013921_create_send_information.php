<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_infomation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question_id')->nullable()->comment('质疑任务关联id');
            $table->string('end_data')->nullable()->comment('截止时间');
            $table->tinyInteger('status')->nullable()->default(1)->comment('状态1:邮件2:电话号码3:其他快递单号4:EMS快递');
            $table->text('content')->nullable()->comment('内容');
            $table->text('sending')->nullable()->comment('发送次数');
            $table->string('email')->nullable()->comment('邮箱（;号隔开账号）');
            $table->string('email_theme')->nullable()->comment('邮件主题');
            $table->string('phone_number')->nullable()->comment('电话号码');
            $table->string('express')->nullable()->comment('快递单号');
            $table->string('ems_express')->nullable()->comment('Ems快递单号');
            $table->timestamps();
            /*软删除*/
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('send_infomation', function (Blueprint $table) {
            //
        });
    }
}
