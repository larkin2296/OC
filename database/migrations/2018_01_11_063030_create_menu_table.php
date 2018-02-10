<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->comment('菜单名称');
            $table->string('route')->nullable()->comment('菜单路由');
            $table->string('icon')->nullable()->comment('菜单图标');
            $table->string('permission')->nullable()->comment('权限');
            $table->string('description')->nullable()->comment('备注');
            $table->integer('sort')->nullable()->default(1)->comment('排序');
            $table->string('route_prefix')->nullable()->comment('路由前缀，高亮显示菜单');
            $table->tinyInteger('position')->nullable()->comment('菜单位置,1-通用,2-后台，3-公司');
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
        Schema::dropIfExists('menus');
    }
}
