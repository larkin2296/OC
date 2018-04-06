<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachement', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable()->default('')->comment('加密文件名');
            $table->string('origin_name')->nullable()->default('')->comment('上传文件名');
            $table->integer('file_size')->nullable()->default(0)->comment('文件大小');
            $table->string('path')->nullable()->default('')->comment('文件相对路径');
            $table->string('file_ext', 10)->nullable()->default('')->comment('文件扩展名');
            $table->string('ext_info')->nullable()->default('')->comment('文件扩展信息');
            $table->integer('user_id')->nullable()->default(0)->comment('上传用户者id');
            $table->string('user_name')->nullable()->default(0)->comment('用户创建者id');

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
        Schema::dropIfExists('attachement');
    }
}
