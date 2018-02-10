<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->comment('账号');
            $table->string('truename')->nullable()->comment('真实姓名');
            $table->tinyInteger('sex')->nullable()->default(1)->comment('性别,1-男,2-女');
            $table->string('mobile', 15)->nullable()->comment('手机号');
            $table->string('email')->nullable()->comment('邮箱');
            $table->tinyInteger('is_check_email')->nullable()->comment('是否验证邮箱');
            $table->integer('company_id')->nullable()->comment('公司id');
            $table->string('company_name')->nullable()->comment('公司名称');
            $table->text('notes')->nullable()->comment('备注');
            $table->string('password')->nullable()->comment('密码');
            $table->tinyInteger('status')->nullable()->default(1)->comment('1-正常，2-关闭');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
