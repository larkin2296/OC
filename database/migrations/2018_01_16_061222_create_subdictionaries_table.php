<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubdictionariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subdictionaries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sub_chinese')->nullable()->comment('字典子数据的中文');
            $table->string('sub_english')->nullable()->comment('字典子数据的英文');
            $table->string('sub_ename')->nullable()->comment('E2B名称');
            $table->string('sub_eformat')->nullable()->comment('E2B格式');
            $table->integer('dict_id')->nullable()->comment('父关联id');
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
        Schema::dropIfExists('subdictionaries');
    }
}
