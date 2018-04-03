<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlatformConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platform_config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('platform_code',255)->nullable()->comment('平台代码');
            $table->string('platform_name',255)->nullable()->comment('平台名字');
            $table->integer('status')->default('0')->comment('0为启用，1为禁用');
            $table->string('regular',255)->nullable()->comment('平台卡密规则');
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
        Schema::dropIfExists('platform_config');
    }
}
