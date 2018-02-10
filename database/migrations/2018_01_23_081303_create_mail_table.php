<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('service_type')->nullable()->comment('邮件服务类型 0:POP3;1:IMTP');
            $table->string('mail_account')->nullable()->comment('邮件账号');
            $table->string('mail_password')->nullable()->comment('邮件密码');
            $table->tinyInteger('company_id')->nullable()->comment('公司id');
            $table->string('server')->nullable()->comment('服务器信息');
            $table->string('port')->nullable()->comment('服务器端口');
            $table->tinyInteger('ssl_crypt')->nullable()->comment('ssl加密0:开启;1:关闭');
            $table->string('status')->nullable()->comment('启用状态0:开启;1:关闭');
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
        Schema::dropIfExists('mail');
    }
}
